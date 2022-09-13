<?php

// Initialisation de l'environnement
include './config/config.init.php';

include _CTRL_ . 'header.php';

// Gestion de Routing
if (isset($_GET['action']) && file_exists(_CTRL_ . $_GET['action'] . '.php')) {
    include _CTRL_ . $_GET['action'] . '.php';
} elseif (isset($_GET['action']) && !file_exists(_CTRL_ . $_GET['action'] . '.php')) {
    include _CTRL_ . 'erreur.php';
} else {
    include _CTRL_ . 'recherche_film.php';}
<<<<<<< Updated upstream
    //include _CTRL_ . 'offres.php';
=======
    include _CTRL_ . 'recherche_film.php';
>>>>>>> Stashed changes}}
include _CTRL_ . 'footer.php';
