<?php require_once 'conn.php';

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
                    header("Location: profil.php");
                }
                exit;
            } else {
                echo "<script>alert('Incorrect password');</script>";
            }
        } else {
            echo "<script>alert('Incorrect login');</script>";

        }
    }
} catch(PDOException $e) {
    echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
}

$conn = null;
?>