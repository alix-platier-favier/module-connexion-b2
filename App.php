<?php

require_once 'MyPdo.php';

class App
{
    private $pdo;
    public $msgError;
    public $msgSuccess;

    public function __construct()
    {
        try {
            $this->pdo = new MyPdo();
        } catch (PDOException $e) {
            $this->msgError = "<p id='msgerror'Error : " . $e->getMessage() . "</p>";
            exit;
        }
    }

    public function login($login, $password)
    {
        try {
            $user = $this->pdo->getUserByLogin($login);
        } catch (PDOException $e){
            $this->msgError = "<p id='msgerror'>Error : " . $e->getMessage() . "</p>";
            return false;
        }

        if ($user === null) {
            $this->msgError = "<p id='msgerror'>Error : Incorrect Username </p>";
            return false;
        }

        if(password_verify($password, $user->getHashedPwd())) {
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $user->getId();
            $_SESSION['login'] = $user->getLogin();
            return true;
        } else {
            $this->msgError = "<p id='msgerror'>Error : Incorrect Password </p>";
            return false;
        } 
    }

    public function subscribe($login, $firstname, $lastname, $password, $confirmPwd)
    {
        if ($password != $confirmPwd) {
            $this->msgError = "<p id='msgerror'>Error : Passwords do not match </p>";
            return false;
        }
        if (
            !empty($password) && (strlen($password) <8 || //length
            !preg_match('/[a-zA-Z]/', $password) || //chars
            !preg_match('/\d/', $password) || //nmbrs
            !preg_match('/[^a-zA-Z\d]/', $password) //specials chars
            )
        ) {
            $this->msgError = "<p id='msgerror'>Error : Password must contain at least 8 characters, 1 uppercase letter, 1 lowercase letter and 1 number </p>";
            return false;
        }
        try {
            if ($this->pdo->getUserbyLogin($login) !== null) {
                $this->msgError = "<p id='msgerror'>Error : " . $login . " is already taken </p>";
                return false;
            }
            $this->pdo->addUser($login, $firstname, $lastname, $password);
        } catch (PDOException $e) {
            $this->msgError = "<p id='msgerror'>Error : " . $e->getMessage() . "</p>";
            return false;
        }
    }

    public function updateProfile($newLogin, $oldPwd, $newPwd, $confirmPwd)
    {
        try {
            $user = $this->pdo->getUserByLogin($_SESSION['login']);

            if (!password_verify($oldPwd, $user->getHashedPwd())) {
                $this->msgError = "<p id='msgerror'>Error : Incorrect Password </p>";
                return false;
            }

            if ($newLogin !== $_SESSION['login'] && $this->pdo->getUserByLogin($newLogin) !== null) {
                $this->msgError = "<p id='msgerror'>Error :" . $newLogin . "already taken </p>";
                return false;
            }

            if ($newPwd != $confirmPwd) {
                $this->msgError = "<p id='msgerror'>Error : Passwords do not match </p>";
                return false;
            }

            if (
                !empty($newPwd) && (strlen($newPwd) <8 || //length
                !preg_match('/[a-zA-Z]/', $newPwd) || //chars
                !preg_match('/\d/', $newPwd) || //nmbrs
                !preg_match('/[^a-zA-Z\d]/', $newPwd) //specials chars
                )
            ) {
                $this->msgError = "<p id='msgerror'>Error : Password must contain at least 8 characters, 1 uppercase letter, 1 lowercase letter and 1 number </p>";
                return false;
            }

        } catch (PDOException $e){
            $this->msgError = "<p id='msgerror'>Error : " . $e->getMessage() . "</p>";
            return false;
        }

        $_SESSION['login'] = $newLogin;
        return true;
    }
}


