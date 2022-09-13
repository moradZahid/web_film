<?php


$userDao = new UserDao();
$users = $userDao->getAll();
$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : ''; 
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';

echo $twig->render('manage_user.html.twig',[
    'msg' => $msg,
    'error' => $error,
    'users' => $users
]);
unset($_SESSION['msg']);
unset($_SESSION['error']);