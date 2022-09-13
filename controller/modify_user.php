<?php
include('controllerFunctions.php');

try
{
    // validation du formulaire et recupération des données
    $modifyUserForm = new ModifyUserForm();
    $user = $modifyUserForm->getData();
   
    // modification de l'utilisateur
    $userDao = new UserDao();
    $userDao->modifyUser($user);
    
    $url = buildUrlUserManager('admin');
    header('Location:'.$url);  
}
catch(Exception $e)
{
    $_SESSION['error'] = $e->getMessage();
    $url = buildUrlUserManager('admin');
    header('Location:'.$url);
}