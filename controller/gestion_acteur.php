<?php
//gere connection et les function 
$ActeursDao = new ActeursDAO();


if (isset($_POST['type'])) {
    switch ($_POST['type']) {
        case 'add':
            //Crée une nouveau acteur
            $acteur = new Acteurs(null, $_POST['nom'], $_POST['prenom']);
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

            $idActeur = $_POST['idActeur'];

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
            $acteur = new Acteurs($_POST['idActeur'], $_POST['nom'], $_POST['prenom']);

            //Function delete sur l'id de l'offre
            $status = $ActeursDao->modifyActeur($acteur);

            //Si $statut est executé alors affiche dans delete_offre.twig l'id avec msg "supprimé"
            if ($status) {
                $msg = "L'acteur à été modifié ";
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

$allActeurs = $ActeursDao->getAll();

echo $twig->render('gestion_acteur.html.twig', ['allActeurs' => $allActeurs, 'status' => $msg]);
