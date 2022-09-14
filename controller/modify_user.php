<?php
include('controllerFunctions.php');

//check_authorisation(check_idUser());

try
{
    // validation du formulaire et recupération des données
    $modifyUserForm = new ModifyUserForm();
    $user = $modifyUserForm->getData();
   
    // modification de l'utilisateur
    $userDao = new UserDao();
    $userDao->modifyUser($user);
    
    $url = buildUrlUserManager();
    header('Location:'.$url);  
}
catch(Exception $e)
{
    $_SESSION['error'] = $e->getMessage();
    $url = buildUrlUserManager();
    header('Location:'.$url);
}