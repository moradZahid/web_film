<?php
include('controllerFunctions.php');

check_authorisation('user');


try
{
    //gere connection et les function 
    $ActeursDao = new ActeursDAO();

    if (isset($_POST['type'])) {
        switch ($_POST['type']) {
            case 'add':
                $addActeursForm = new AddActeursForm();
                //Crée une nouveau acteur
                $acteur = $addActeursForm->getData();
                //Get les elements, construit la requete sql et insère dans la bdd
                $status = $ActeursDao->add($acteur);

                //Si $statut est executé alors affiche le status avec msg 
                if ($status) {
                    $msg = "L'acteur à bien été ajouté";
                }
                //Sinon alors affiche avec msg erreur  
                else {
                    $msg = "Erreur Ajout";
                }
                break;

            case 'delete':
                //Recupère l'id de l'offre submit
                $acteursForm = new ActeursForm();
                $idActeur = $acteursForm->validateIdActeur();

                //Function delete sur l'id de l'offre
                $status = $ActeursDao->deleteOne($idActeur);

                //Si $statut est executé alors affiche msg "supprimé"
                if ($status) {
                    $msg = "L'acteur à été supprimé ";
                }
                //Sinon alors affiche msg "Erreur"
                else {
                    $msg = "Erreur de suppression";
                }

                break;

            case 'modify':
                $modifyActeursForm = new ModifyActeursForm();
                $acteur = $modifyActeursForm->getData();

                //Function delete sur l'id de l'offre
                $status = $ActeursDao->modifyActeur($acteur);

                //Si $statut est executé alors affiche dans delete_offre.twig l'id avec msg "supprimé"
                if ($status) {
                    $msg = "L'acteur à été modifié ";
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

    $allActeurs = $ActeursDao->getAll();
    $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
    echo $twig->render('gestion_acteur.html.twig', [
        'allActeurs' => $allActeurs, 
        'status' => $msg,
        'error' => $error
    ]);
    unset($_SESSION['error']);
}
catch(Exception $e)
{
    $_SESSION['error'] = $e->getMessage();
    $url = './?action=gestion_acteur';
    header('Location:'.$url);
}