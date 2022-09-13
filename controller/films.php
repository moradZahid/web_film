<?php

//On appelle la fonction getAll()
$filmsDao = new FilmsDAO();
$allFilms = $filmsDao->getAll();



//On affiche le template Twig correspondant
echo $twig->render('films.html.twig', ['allFilms' => $allFilms]);
