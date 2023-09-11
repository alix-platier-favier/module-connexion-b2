<?php require_once 'login.php';?>
<?php require_once 'MyPdo.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astro-connection</title>
    <link rel="stylesheet" href="style.css">
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
            <button class="btn" onclick="window.location.href=login.php">Login</button>
        </div>
    </div>
    
    <div class="wrapper">
        <div class="title-txt">
            <div class="title login">
                Login
            </div>
            <div class="title signup">
                Signup
            </div>
        </div>
        <div class="form-container">
            <div class="slide-ctrls">
            <input type="radio" name="slide" id="login" checked>
            <input type="radio" name="slide" id="signup">
            <label for="login" class="slide login">Login</label>
            <label for="signup" class="slide signup">Signup</label>
            <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
            <form action="signup.php" method="post" class="login">
                <div class="field">
                    <input type="text" placeholder="Username" name="login" required>
                </div>
                <div class="field">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <div class="checkbox">
                        <label><input type="checkbox" required>
                        I agree to the terms & conditions</label>
                    </div>
                <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Login">
                </div>
                <div class="signup-link">
                    Not a member? <a href="">Signup now</a>
                </div>
            </form>
            <form action="login.php" method="post" class="signup">
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
                <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Signup">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
