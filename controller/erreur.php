<?php

if (filter_has_var(INPUT_GET,'msg'))
{
    $msg = filter_input(INPUT_GET,'msg',FILTER_SANITIZE_SPECIAL_CHARS);
    
    //On affiche le template Twig correspondant
    echo $twig->render('erreur.html.twig', ['erreur' => $msg]);
}