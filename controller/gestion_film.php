<?php
include('controllerFunctions.php');

// verifie si l'utilisateur est autorisé à executer le script
check_authorisation('user');

try
{
    //gere connection et les function 
    $filmsDao = new FilmsDAO();

    //Si titre ou realisateur est soumis
    if (isset($_POST['type'])) {
        switch ($_POST['type']) {
            case 'add':
                $addFilmsForm = new AddFilmsForm();
                //Crée une nouveau film 
                $film = $addFilmsForm->getData();
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
                $filmsForm = new FilmsForm();
                $idFilm = $filmsForm->validateIdFilm();

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
                $modifyFilmsForm = new ModifyFilmsForm();
                $film = $modifyFilmsForm->getData();

                //Function delete sur l'id de l'offre
                $status = $filmsDao->modifyFilm($film);

                //Si $statut est executé alors affiche dans delete_offre.twig l'id avec msg "supprimé"
                if ($status) {
                    $msg = "Le film à été modifié ";
                }
                //Sinon alors affiche dans delete_offre.twig l'id avec msg "Erreur"
                else {
                    $msg = "Aucun film modifié";
                }

                break;
        }
    } else {
        $msg = "";
    }

    $allFilms = $filmsDao->getAll();
    $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
    echo $twig->render('gestion_film.html.twig', [
        'allFilms' => $allFilms, 
        'status' => $msg,
        'error' => $error
    ]);
    unset($_SESSION['error']);
}
catch(Exception $e)
{
    $_SESSION['error'] = $e->getMessage();
    $url = './?action=gestion_film';
    header('Location:'.$url);
}