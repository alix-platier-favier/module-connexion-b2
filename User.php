<?php

class User 
{
    public function __construct(private int $id, private string $login, private string $firstname, private string $lastname, private string $hashedPwd)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLogin(): string 
    {
        return $this->login;
    }

    public function getFirstname(): string 
    {
        return $this->firstname;
    }

    public function getLastname(): string 
    {
        return $this->lastname;
    }

    public function getHashedPwd(): string 
    {
        return $this->hashedPwd;
    }
}