<?php
include('controllerFunctions.php');

try
{
    // validation du formulaire et recupération des données
    $addUserForm = new AddUserForm();
    $user = $addUserForm->getData();
   
    // modification de l'utilisateur
    $userDao = new UserDao();
    $userDao->add($user);
    
    $url = buildUrlUserManager();
    header('Location:'.$url);  
}
catch(Exception $e)
{
    $_SESSION['error'] = $e->getMessage();
    $url = buildUrlUserManager();
    header('Location:'.$url);
}