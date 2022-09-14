<?php
include('controllerFunctions.php');

check_authorisation('user');

$userDao = new UserDao();
$user = $userDao->getOne($_SESSION['idUser']);

$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : ''; 
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';

echo $twig->render('manage_account.html.twig',[
    'msg' => $msg,
    'error' => $error,
    'user' => $user
]);
unset($_SESSION['msg']);
unset($_SESSION['error']);