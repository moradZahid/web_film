<?php

class ModifyUserForm extends UserForm
{
    public function validateForgetMe()
    {
        if (filter_has_var(INPUT_POST,'forgetMe'))
        {
            if(filter_input(INPUT_POST,'forgetMe',FILTER_UNSAFE_RAW) == 'on')
            {
                return true;
            }
        }
        return false; 
    }

    public function getData()
    {
        $idUser = $this->validateIdUser();
        $userName = $this->validateUserName();
        $email = $this->validateEmail();
        $forgetMe = $this->validateForgetMe();

        if ($forgetMe)
        {
            setcookie('email');
        }
        return new User($idUser,$userName,$email,null);
    }
}