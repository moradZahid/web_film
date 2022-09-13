<?php

class ModifyPasswordUserForm extends UserForm
{
    public function getData()
    {
        $idUser = $this->validateIdUser();
        $password1 = $this->validatePassword(1);
        $password2 = $this->validatePassword(2);
        
        if ($password1 != $password2)
        {
            throw new Exception('Mot de passe invalide.');
        }
        return new User($idUser,null,null,$password1);
    }
}