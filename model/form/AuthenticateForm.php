<?php

class AuthenticateForm extends UserForm
{
    public function getData()
    {
        $email = $this->validateEmail();
        $password = $this->validatePassword();
        
        return new User(null,null,$email,$password);
    }
}