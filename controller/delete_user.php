<?php
include('controllerUserFunctions.php');

try
{
    // verification de l'idUser
    $idUser = check_idUser();

    // suppression de l'utilisateur
    $userDao = new UserDao();
    $userDao->deleteUser($idUser);
    
    $url = './?action=manage_user';
    header('Location:'.$url);  
}
catch(Exception $e)
{
    $_SESSION['error'] = $e->getMessage();
    $url = './?action=manage_user';
    header('Location:'.$url);
}