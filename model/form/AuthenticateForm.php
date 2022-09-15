<?php

class AuthenticateForm extends UserForm
{
    
    public function validateRememberMe()
    {
        if (filter_has_var(INPUT_POST,'rememberMe'))
        {
            if(filter_input(INPUT_POST,'rememberMe',FILTER_UNSAFE_RAW) == 'on')
            {
                return true;
            }
        }
        return false; 
    }

    public function getData()
    {
        $email = $this->validateEmail();
        $password = $this->validatePassword();
        $rememberMe = $this->validateRememberMe();
        if ($rememberMe)
        {
            setcookie('email',$email,time()+1000000);
        }    
        return new User(null,null,$email,$password);
    }
}