<?php
include('controllerFunctions.php');

// verifie si l'utilisateur est autorisé à executer le script
check_authorisation();

try
{
    // verification de l'idUser
    $idUser = check_idUser();

    // suppression de l'utilisateur
    $userDao = new UserDao();
    $userDao->deleteUser($idUser);
    
    $url = buildUrlUserManager('delete');
    header('Location:'.$url);  
}
catch(Exception $e)
{
    $_SESSION['error'] = $e->getMessage();
    $url = buildUrlUserManager();
    header('Location:'.$url);
}
