<?php
//gere connection et les function 
$filmsDao = new FilmsDAO();


//Si titre ou realisateur est soumis
if (isset($_POST['realisateur'])) {
    //Crée une nouveau film 
    $film = new Films(null, $_POST['titre'], $_POST['realisateur'], $_POST['affiche'], $_POST['annee']);
    var_dump($film);
    //Get les elements, construit la requete sql et insère dans la bdd
    $status = $filmsDao->add($film);

    //Si $statut est executé alors affiche dans creer_offre.twig le status avec msg 
    if ($status) {
        echo $twig->render('creation_element.html.twig', ['status' => "Le film à été ajouté", 'film' => $film]);
    }
    //Sinon alors affiche dans creer_offre.twig le status avec msg erreur  
    else {
        echo $twig->render('creation_element.twig', ['status' => "Erreur Ajout"]);
    }
} else {
    echo $twig->render('creation_element.html.twig');
}
