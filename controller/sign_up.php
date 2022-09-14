<?php
include('controllerFunctions.php');

try
{
    if (filter_has_var(INPUT_POST,'submitted'))
    {
        // validation du formulaire et recupération des données
        $addUserForm = new AddUserForm();
        $user = $addUserForm->getData();

        // modification de l'utilisateur
        $userDao = new UserDao();
        $userDao->add($user);

        $url = './?action=authenticate';
        header('Location:'.$url); 
    }
    else
    {
         // affichage du formulaire
         $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
         echo $twig->render('sign_up.html.twig',[
             'error' => $error
         ]);
         unset($_SESSION['error']);
    }
}
catch(Exception $e)
{
    $_SESSION['error'] = $e->getMessage();
    $url = './?action=sign_up';
    header('Location:'.$url);
}