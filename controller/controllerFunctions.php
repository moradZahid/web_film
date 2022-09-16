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
            if (isset($_SESSION['isAdmin']))
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
        if (isset($_SESSION['isAdmin']))
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

function check_authorisation($option='')
{
    try 
    {
        if (isset($_SESSION['isAdmin']))
        {
            return true;
        }
        if ($option == 'admin_page')
        {
            throw new Exception('Accès non authorisé.');
        }
        if (!isset($_SESSION['email']))
        {
            throw new Exception('Accès non authorisé.');   
        }
        if (strlen($option) === 0)
        {
            $id = check_idUser();
            if ($_SESSION['idUser'] != $id)
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

function make_keywords_title()
{
    $titre = filter_input(INPUT_POST,'titre',FILTER_SANITIZE_SPECIAL_CHARS);
    $titre = strtolower($titre);
    $titre = trim($titre);
    return preg_split('/\s+/',$titre);
}

function authenticate_automatically()
{
    if (isset($_SESSION['email']))
    {
        return true;
    }
    if (!isset($_COOKIE['email']))
    {
        return true;
    }
    $userDao = new UserDao();
    $email = $_COOKIE['email'];
    $data = $userDao->getPasswordHash($email);
    if (!$data)
    {
        return true;
    }
    $_SESSION['email'] = $email;
    $_SESSION['idUser'] = $data['idUser'];
    check_admin($_SESSION['idUser']);
    if (isset($_SESSION['isAdmin']))
    {
        $url = './?action=sign_out';
    }
    else
    {
        $url = './';
    }
    header('Location:'.$url);
}

function alterTableRole()
{
    if (isset($_COOKIE['alterTable']))
    {
        return true;
    }
    setcookie('alterTable','role',time()+1000000);
    $rolesDao = new RolesDAO();
    $rolesDao->alterTable();
    header('Location:./');
}