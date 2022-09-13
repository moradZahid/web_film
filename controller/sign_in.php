<?php
include('controllerFunctions.php');

try
{
    if (filter_has_var(INPUT_POST,'submitted'))
    {
        // validation du formulaire et recupération des données
        $authenticationForm = new authenticationForm();
        $user = $authenticationForm->getData();

        // verification du login et du mot de passe
        $userDao = new UserDao();
        $userDao->modifyPassword($user);
        
        $url = buildUrlUserManager('admin');
        header('Location:'.$url);
    }
    else
    {
        // verification de l'idUser
        $idUser = check_idUser();
        $_SESSION['id_modification_password'] = $idUser;

        // gestion de l'annulation
        check_cancel_modification_password();
        
        // affichage du formulaire
        $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
        echo $twig->render('modify_password_user.html.twig',[
            'error' => $error,
            'idUser' => $idUser
        ]);

    }
}
catch(Exception $e)
{
    $_SESSION['error'] = $e->getMessage();    
    $url = buildUrlUserManager('admin',$_SESSION['id_modification_password']);
    header('Location:'.$url);
}