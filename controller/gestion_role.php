<?php
//gere connection et les function 
$roleDao = new RolesDAO();
$filmsDao = new FilmsDAO();
$acteursDao = new ActeursDAO();


if (isset($_POST['type'])) {
    switch ($_POST['type']) {
        case 'add':
            //Crée un nouveau Role
            $role = new Role($_POST['personnage'], null, $_POST['idFilm'], null, null, $_POST['idActeur']);
            //Get les elements, construit la requete sql et insère dans la bdd

            $status = $roleDao->add($role);

            //Si $statut est executé alors affiche le status avec msg 
            if ($status) {
                $msg = "Le role à bien été ajouté";
            }
            //Sinon alors affiche avec msg erreur  
            else {
                $msg = "Erreur Ajout";
            }
            break;

        case 'delete':
            //Recupère l'id de role submit

            $idRole = $_POST['idRole'];

            //Function delete sur l'id de l'offre
            $status = $roleDao->deleteOne($idRole);

            //Si $statut est executé alors affiche msg "supprimé"
            if ($status) {
                $msg = "Le role à été supprimé ";
            }
            //Sinon alors affiche msg "Erreur"
            else {
                $msg = "Erreur de suppression";
            }

            break;

        case 'modify':
            $role = new Role($_POST['personnage'], $_POST['idRole'], $_POST['idFilm'], null, null, $_POST['idActeur']);

            //Function delete sur l'id de role
            $status = $roleDao->modifyRole($role);

            //Si $statut est executé alors affiche l'id avec msg "supprimé"
            if ($status) {
                $msg = "Le role à été modifié ";
            }
            //Sinon alors affiche  avec msg "Erreur"
            else {
                $msg = "Erreur de modification";
            }

            break;
    }
} else {
    $msg = "";
}

$allRoles = $roleDao->getAll();
$allFilms = $filmsDao->getAll();
$allActeurs = $acteursDao->getAll();


echo $twig->render('gestion_role.html.twig', ['allRoles' => $allRoles, 'status' => $msg, 'allActeurs' => $allActeurs, 'allFilms' => $allFilms]);
