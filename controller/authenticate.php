<?php
include('controllerFunctions.php');

try
{
    if (filter_has_var(INPUT_POST,'submitted'))
    {
        // validation du formulaire et recupération des données
        $authenticateForm = new AuthenticateForm();
        $user = $authenticateForm->getData();

        
        // verification du login et du mot de passe
        check_authentification($user);
        
        header('Location: ./');
    }
    else
    {
        // affichage du formulaire
        $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : ''; 
        $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
        echo $twig->render('authenticate.html.twig',[
            'msg' => $msg,
            'error' => $error
        ]);
        unset($_SESSION['error']);
    }
}
catch(Exception $e)
{
    $_SESSION['error'] = $e->getMessage();    
    $url = './?action=authenticate';
    header('Location:'.$url);
}