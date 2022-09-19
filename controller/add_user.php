<?php
include('controllerFunctions.php');

// verifie si l'utilisateur est autorisé à executer le script
check_authorisation('admin_page');

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