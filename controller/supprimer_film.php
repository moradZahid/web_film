<?php

//gere connection et les function getAll(), add($data), getOne($id_offer), deleteOne($idOffer)
$filmsDao = new FilmsDAO();


//Recupère l'id de l'offre submit

$idFilm = $_POST['idFilm'];

//Function delete sur l'id de l'offre
$status = $filmsDao->deleteOne($idFilm);

//Si $statut est executé alors affiche dans delete_offre.twig l'id avec msg "supprimé"
if ($status) {
    $msg = "Le film à été supprimé ";
}
//Sinon alors affiche dans delete_offre.twig l'id avec msg "Erreur"
else {
    $msg = "Erreur de suppression";
}

echo $twig->render('gestion_film.html.twig', ['status' => $msg]);
