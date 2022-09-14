<?php
include('controllerFunctions.php');

try
{
    // verification de l'idUser
    $idUser = check_idUser();

    // suppression de l'utilisateur
    $userDao = new UserDao();
    $userDao->deleteUser($idUser);
    
    $url = buildUrlUserManager();
    header('Location:'.$url);  
}
catch(Exception $e)
{
    $_SESSION['error'] = $e->getMessage();
    $url = buildUrlUserManager();
    header('Location:'.$url);
}