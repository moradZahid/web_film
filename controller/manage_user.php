<?php
include('controllerFunctions.php');

// verifie si l'utilisateur est autorisé à executer le script
check_authorisation('admin_page');

// récupère les données de tous les utilisateurs
$userDao = new UserDao();
$users = $userDao->getAll();

$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : ''; 
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';

// afficher les formulaires de gestion des données des utilisateurs
echo $twig->render('manage_user.html.twig',[
    'msg' => $msg,
    'error' => $error,
    'users' => $users
]);
unset($_SESSION['msg']);
unset($_SESSION['error']);