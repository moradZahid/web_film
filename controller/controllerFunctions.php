<?php

function check_idUser()
{
    if (!filter_has_var(INPUT_GET,'id'))
    {
        throw new Exception('Erreur dans le formulaire.');
    }
    $idUser = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
    if (!$idUser)
    {
        throw new Exception('Erreur dans le formulaire.');
    }
    return $idUser;
}    

function buildUrlUserManager($user,$id=null)
{
    if ($user == 'admin')
    {
        if (isset($id)) 
        {
            return './?action=modify_password_user&id='.$id;
        }
        return './?action=manage_user';
    }
}

function check_cancel_modification_password()
{
    if (filter_has_var(INPUT_GET,'cancel'))
    {
        $url = buildUrlUserManager('admin');
        header('Location:'.$url);
        return;
    }   
}