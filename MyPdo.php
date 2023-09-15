<?php

require_once 'User.php';
require_once 'conn.php';

define("SERVERNAME", "localhost:3306");
define("USERNAME", "root");
define("PASSWORD", "");
define("DBNAME", "moduleconnexionb2");

class MyPdo
{
    private $connection;

    public function __construct()
    {

        $this->connection = new PDO("mysql:host=" . SERVERNAME . ";dbname=" . DBNAME, USERNAME, PASSWORD);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getUserByLogin($login)
    {
        $stmt = $this->connection->prepare("SELECT * FROM user WHERE login = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            return new User($row['id'], $row['login'], $row['firstname'], $row['lastname'], $row['password']);
        } else {
            return null;
        }
    }

        public function getUserbyId($id)
        {
            $stmt = $this->connection->prepare("SELECT * FROM user WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch();
                return new User($row['id'], $row['login'], $row['firstname'], $row['lastname'], $row['password']);
            } else {
                return null;
            }
        }

        public function addUser($login, $firstname, $lastname, $password)
        {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->connection->prepare("INSERT INTO user (login, firstname, lastname, password) VALUES (:login, :firstname, :lastname, :password)");
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();
        }

        public function updateUser($login, $newLogin, $password)
        {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->connection->prepare("UPDATE user SET login = :newLogin, firstname = :firstname, lastname = :lastname, password = :password WHERE login = :login");
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':newLogin', $newLogin);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();
        }
}

?>