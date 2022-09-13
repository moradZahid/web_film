<?php
$ActeursDao = new ActeursDAO();

if (isset($_POST['nom'])) {

    //Crée une nouvel acteur
    $acteur = new Acteurs(null, $_POST['nom'], $_POST['prenom']);

    //Get les elements, construit la requete sql et insère dans la bdd
    $status = $ActeursDao->add($acteur);

    //Si $statut est executé alors affiche dans creer_film.twig le status avec msg 
    if ($status) {
        echo $twig->render('creer_film.html.twig', ['status' => "L'acteur'à été ajouté", 'acteur' => $acteur]);
    }
    //Sinon alors affiche dans creer_film.twig le status avec msg erreur  
    else {
        echo $twig->render('creer_film.html.twig', ['status' => "Erreur Ajout"]);
    }
} else {
    echo $twig->render('creer_film.html.twig');
}
