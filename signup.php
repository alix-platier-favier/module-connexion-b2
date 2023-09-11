<?php
require_once 'MyPdo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];

    $pdo = new MyPdo();
    $pdo->addUser($login, $firstname, $lastname, $password);

    header('Location: login.php');
    exit;
}
?>
