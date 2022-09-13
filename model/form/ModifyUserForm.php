<?php

class ModifyUserForm extends UserForm
{
    public function getData()
    {
        $idUser = $this->validateIdUser();
        $userName = $this->validateUserName();
        $email = $this->validateEmail();
        
        return new User($idUser,$userName,$email,null);
    }
}