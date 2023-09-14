<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astro-connection</title>
    <link rel="stylesheet" href="CSS/bg.css">
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
            <!-- MENU -->
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
</body>
</html>
