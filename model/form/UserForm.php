<?php

class UserForm
{
    public function validateIdUser()
    {
        if (!filter_has_var(INPUT_POST,'idUser'))
        {
            throw new Exception('Erreur dans le formulaire.');
        }
        $idUser = filter_input(INPUT_POST,'idUser',FILTER_VALIDATE_INT);
        if (!$idUser)
        {
            throw new Exception('Erreur dans le formulaire.');
        }
        return $idUser;  
    }
    
    public function validateUserName()
    {
        if (!filter_has_var(INPUT_POST,'userName'))
        {
            throw new Exception('Erreur dans le formulaire.');
        }
        $userName = filter_input(INPUT_POST,'userName',FILTER_SANITIZE_SPECIAL_CHARS);
        if (strlen($userName) == 0)
        {
            throw new Exception('Tous les champs sont obligatoires.');
        }
        return $userName;
    }

    public function validateEmail()
    {
        if (!filter_has_var(INPUT_POST,'email'))
        {
            throw new Exception('Erreur dans le formulaire.');
        }
        $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
        if (!$email)
        {
            throw new Exception('Email invalide.');
        }
        if (strlen($email) == 0)
        {
            throw new Exception('Tous les champs sont obligatoires.');
        }
        return $email;
    }

    public function validatePassword($nbr)
    {
        if (!filter_has_var(INPUT_POST,'password'.$nbr))
        {
            throw new Exception('Erreur dans le formulaire.');
        }
        $password = filter_input(INPUT_POST,'password'.$nbr,FILTER_UNSAFE_RAW);
        if (strlen($password) == 0)
        {
            throw new Exception('Tous les champs sont obligatoires.');
        }
        return $password;
    }
}