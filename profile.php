<?php require_once 'conn.php';?>
<?php require_once 'App.php';?>

<?php

$app = new App();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: loginSignup.php");
    exit;
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $login = $_SESSION['login'];
    $stmt = $conn->prepare("SELECT * FROM user WHERE login = :login");
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $hashedPassword = $user['password'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $oldPwd = $_POST['oldPwd'];
        $newPwd = $_POST['password'];
        $confirmPwd = $_POST['confirmPwd'];

        if (!password_verify($oldPwd, $hashedPassword)) {
            $app->msgError = "<p id='msgerror'>Old Password is incorrect</p>";
            exit;
        }

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];

        $hashedNewPassword = password_hash($newPwd, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("UPDATE user SET firstname = :firstname, lastname = :lastname, password = :password WHERE login = :login");
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':password', $hashedNewPassword);
        $stmt->bindParam(':login', $login);
        $stmt->execute();

        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;

        $app->msgError = "<p id='msgerror' style='color: green;'>Profile Info updated with success!</p>";
    }
} catch(PDOException $e) {
    $this->msgError = "<p id='msgerror'>Error : " . $e->getMessage() . "</p>";
}

$conn = null;
?>

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
        <div class="container">
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
        <div class="title-text">
            Update my info
        </div>
        <div class="form-inner">
            <form action="" method="post" class="signup">
                <div class="field">
                    <input type="text" placeholder="Username" name="login" value="<?php echo $_SESSION['login']; ?>">
                </div>  
                <div class="field">
                    <input type="text" placeholder="First Name" name="firstname" value="<?php echo $_SESSION['firstname']; ?>">
                </div>
                <div class="field">
                    <input type="text" placeholder="Last Name" name="lastname" value="<?php echo $_SESSION['lastname']; ?>">
                </div>
                <div class="field">
                    <input type="password" placeholder="Old Password" name="oldPwd" required>
                </div>
                <div class="field">
                    <input type="password" placeholder="New Password" name="password">
                </div>
                <div class="field">
                    <input type="password" placeholder="Confirm New Password" name="confirmPwd">
                </div>
                <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Save">
                </div>
                <?php if (isset($app->msgError)) {echo $app->msgError;} ?>
            </form>
        </div>
    </div>
</body>
</html>


