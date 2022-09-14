<?php

function check_idUser()
{
    try
    {
        if (filter_has_var(INPUT_POST,'idUser'))
        {    
            $idUser = filter_input(INPUT_POST,'idUser',FILTER_VALIDATE_INT);
            if (!$idUser)
            {
                throw new Exception('Erreur dans le formulaire.');
            }
            return $idUser;
        }
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
    catch(Exception $e)
    {
        $url = './?action=erreur&msg=';
        $url .= urlencode($e->getMessage());
        header('Location:'.$url);
    }   
}    

function buildUrlUserManager($option=null)
{
    if (isset($option)) 
    {
        if ($option == 'delete')
        {
            if ($_SESSION['isAdmin'])
            {
                $url = './?action=manage_user';    
            }
            else
            {
                $url = './?action=sign_out';
            }
        }
        else 
        {
            $url = './?action=modify_password_user&id='.$option;
        } 
    }
    else 
    {
        if ($_SESSION['isAdmin'] )
        {
            $url = './?action=manage_user';
        }
        else 
        {
            $url = './?action=manage_account';
        }
    }
    return $url;
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

function check_authentification($user)
{
    $userDao = new UserDao();
    $pswd = $userDao->getPasswordHash($user->getEmail());
    if (!$pswd)
    {
        throw new Exception('Email et mot de passe incorrectes.');
    }
    if (!password_verify($user->getPassword(),$pswd['password']))
    {
        throw new Exception('Email ou mot de passe incorrectes.');
    }
    $_SESSION['email'] = $user->getEmail();
    $_SESSION['idUser'] = $pswd['idUser'];
    check_admin($_SESSION['idUser']);
}

function check_admin($idUser)
{
    $userDao = new UserDao();
    $user = $userDao->getOne($idUser);
    if ($user->getUserName() == 'admin')
    {
        $_SESSION['isAdmin'] = true;
    }
}

function check_authorisation($idUser=null)
{
    try 
    {
        if ($_SESSION['isAdmin'])
        {
            return true;
        }
        if (!isset($_SESSION['email']))
        {
            throw new Exception('Accèss non authorisé.');
        }
        if (isset($idUser))
        {
            if ($idUser != $_SESSION['idUser'])
            {
                throw new Exception('Accès non authorisé.');
            }
        }
        return true;
    }
    catch(Exception $e)
    {
        $url = './?action=erreur&msg=';
        $url .= urlencode($e->getMessage());
        header('Location:'.$url);
    }
}

function check_authorisation_admin_page()
{
    try
    {
        if (!$_SESSION['isAdmin'])
        {
            throw new Exception('Accès non authorisé.');
        }
    }
    catch(Exception $e)
    {
        $url = './?action=erreur&msg=';
        $url .= urlencode($e->getMessage());
        header('Location:'.$url);
    }
}