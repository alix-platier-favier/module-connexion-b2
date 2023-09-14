<?php
require_once 'conn.php';
require_once 'MyPdo.php';
require_once 'App.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$app = new App;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM user WHERE login = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $row['password'];

            if (password_verify($password, $hashed_password)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['login'] = $row['login'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];

                if ($_SESSION['login'] === 'admin') {
                    header("Location: admin.php");
                } else {
                    header("Location: index.php");
                }
                exit;
            } else {
                $app->msgError = "<p id='msgerror'>Incorrect</p>";
            }
    } else {
        $app->msgError = "<p id='msgerror' style='color: green;'>Login with success!</p>";
    }
}} catch (PDOException $e) {
    $app->msgError = "<p id='msgerror'>" . $e->getMessage() . "</p>";
}

$conn = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmpwd'])) {
    $login = $_POST['login'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];
    $confirmPwd = $_POST['confirmpwd'];
    if ($app->subscribe($login, $firstname, $lastname, $password, $confirmPwd)) {
    }
}
?>

<!-------------------------------------------------------------------------------------------------------------------------------->

<?php require_once 'MyPdo.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astro-connection</title>
    <link rel="stylesheet" href="CSS/bg.css">
    <link rel="stylesheet" href="CSS/form.css">
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="topnav">
        <div class="logo">
            <a href="index.php">
            <img src="img\LogoW.png" alt="Logo" height="150px"></a>
            <?php 
                if (!isset($_SESSION['login'])) { 
                    ?>
                    <button class="btn" onclick="location.href='index.php'">Home</button>
                    <button class="btn" onclick="location.href='loginSignup.php'">Login</button>
                <?php 
                } elseif ($_SESSION['login'] === 'admiN1337$') {
                    ?>
                    <button class="btn" onclick="location.href='index.php'">Home</button>
                    <button class="btn" onclick="location.href='profile.php'"><?php echo $_SESSION['login']; ?></button>
                    <button class="btn" onclick="location.href='admin.php'">Admin Panel</button>
                    <button class="btn" onclick="location.href='disconnect.php'">Disconnect</button>
                    <?php
                } else { ?>
                    <button class="btn" onclick="location.href='index.php'">Home</button>
                    <button class="btn" onclick="location.href='profile.php'"><?php echo $_SESSION['login']; ?></button>
                    <button class="btn" onclick="location.href='disconnect.php'">Disconnect</button>
                    <?php                    
                }
            ?>
        </div>
        <div class="planet">
        <div class="sun">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="earth">
            <div class="moon"></div>
        </div>
    </div>
    </div><div class="wrapper">
        <div class="form-container">
            <div class="slide-controls">
            <input type="radio" name="slide" id="login" checked>
            <input type="radio" name="slide" id="signup">
            <label for="login" class="slide login">Login</label>
            <label for="signup" class="slide signup">Signup</label>
            <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
            <form action="" method="post" class="login">
                <div class="field">
                    <input type="text" placeholder="Username" name="login" required>
                </div>
                <div class="field">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Login">
                </div>
                <div class="signup-link">
                    Not a member? <a href="">Signup now</a>
                </div>
                <?php if (isset($app->msgError)) {echo $app->msgError;} ?>
            </form>
            <form action="" method="post" class="signup">
                <div class="field">
                    <input type="text" placeholder="Username" name="login" required>
                </div>  
                <div class="field">
                    <input type="text" placeholder="First Name" name="firstname" required>
                </div>
                <div class="field">
                    <input type="text" placeholder="Last Name" name="lastname" required>
                </div>
                <div class="field">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <div class="field">
                    <input type="password" placeholder="Confirm Password" name="confirmpwd" required>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" required>
                    I agree to the terms & conditions</label>
                </div>
                <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Signup">
                </div>
                <?php if (isset($app->msgError)) {echo $app->msgError;} ?>
            </form>
        </div>
    </div>
</body>
</html>

