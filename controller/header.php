<?php
//On affiche le template Twig correspondant
if (isset($_SESSION['email']))
{
    $isAutenticated = true;
    $email = $_SESSION['email'];
}
else 
{
    $isAutenticated = false;
    $email = '';
}
echo $twig->render('header.html.twig',[
    'isAuthenticated' => $isAutenticated,
    'email' => $email
]);
