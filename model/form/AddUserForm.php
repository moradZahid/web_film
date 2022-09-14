<?php

class AddUserForm extends UserForm
{
    public function getData()
    {
        $userName = $this->validateUserName();
        $email = $this->validateEmail();
        $password1 = $this->validatePassword(1);
        $password2 = $this->validatePassword(2);
        
        if ($password1 != $password2)
        {
            throw new Exception('Mot de passe invalide.');
        }
        if ($userName == 'admin')
        {
            throw new Exception('Action non authorisée.');
        }
        return new User(null,$userName,$email,$password1);
    }
}