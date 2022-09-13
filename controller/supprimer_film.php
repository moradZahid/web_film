<?php

//gere connection et les function getAll(), add($data), getOne($id_offer), deleteOne($idOffer)
$filmsDao = new FilmsDAO();


//Recupère l'id de l'offre submit

$idFilm = $_POST['idFilm'];

//Function delete sur l'id de l'offre
$status = $filmsDao->deleteOne($idFilm);

//Si $statut est executé alors affiche dans delete_offre.twig l'id avec msg "supprimé"
if ($status) {
    echo $twig->render('supprimer_film.html.twig', ['status' => "Le film $idFilm à été supprimé ", 'film' => $idFilm]);
}
//Sinon alors affiche dans delete_offre.twig l'id avec msg "Erreur"
else {
    echo $twig->render('supprimer_film.html.twig', ['status' => "Erreur suppression"]);
}
