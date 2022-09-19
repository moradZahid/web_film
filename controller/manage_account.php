<?php
include('controllerFunctions.php');

// verifie si l'utilisateur est autorisé à executer le script
check_authorisation('user');

// récupère les données de l'utilisateur
$userDao = new UserDao();
$user = $userDao->getOne($_SESSION['idUser']);

$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : ''; 
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';

// afficher le formulaire de gestion des données de l'utilisateur
echo $twig->render('manage_account.html.twig',[
    'msg' => $msg,
    'error' => $error,
    'user' => $user
]);
unset($_SESSION['msg']);
unset($_SESSION['error']);