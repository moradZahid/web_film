<?php

class User
{
    private $idUser;
    private $userName;
    private $email;
    private $password;

    public function __construct($idUser,$userName,$email,$password)
    {
        $this->idUser = $idUser;
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function getUserName()
    {
        return $this->userName;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
}