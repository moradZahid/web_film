<?php
$acteursDao = new ActeursDAO();
$allActeurs = $acteursDao->getAll();

echo $twig->render('films.html.twig', ['allActeurs' => $allActeurs]);
