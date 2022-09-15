<?php
//gere connection et les function 
$filmsDao = new FilmsDAO();

//Si titre ou realisateur est soumis
if (isset($_POST['type'])) {
    switch ($_POST['type']) {
        case 'add':
            //Crée une nouveau film 
            $film = new Films(null, $_POST['titre'], $_POST['realisateur'], $_POST['affiche'], $_POST['annee']);
            //Get les elements, construit la requete sql et insère dans la bdd
            $status = $filmsDao->add($film);

            //Si $statut est executé alors affiche dans creer_offre.twig le status avec msg 
            if ($status) {
                $msg = "Le film à bien été ajouté";
            }
            //Sinon alors affiche dans creer_offre.twig le status avec msg erreur  
            else {
                $msg = "Erreur Ajout";
            }
            break;

        case 'delete':
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

            break;

        case 'modify':
            $film = new Films($_POST['idFilm'], $_POST['titre'], $_POST['realisateur'], $_POST['affiche'], $_POST['annee']);

            //Function delete sur l'id de l'offre
            $status = $filmsDao->modifyFilm($film);

            //Si $statut est executé alors affiche dans delete_offre.twig l'id avec msg "supprimé"
            if ($status) {
                $msg = "Le film à été modifié ";
            }
            //Sinon alors affiche dans delete_offre.twig l'id avec msg "Erreur"
            else {
                $msg = "Erreur de modification";
            }

            break;
    }
} else {
    $msg = "";
}

$allFilms = $filmsDao->getAll();

echo $twig->render('gestion_film.html.twig', ['allFilms' => $allFilms, 'status' => $msg]);
