<?php
include('controllerFunctions.php');

// verifie si l'utilisateur est autorisé à executer le script
check_authorisation('user');

try
{
    //gere connection et les function 
    $roleDao = new RolesDAO();
    $filmsDao = new FilmsDAO();
    $acteursDao = new ActeursDAO();


    if (isset($_POST['type'])) {
        switch ($_POST['type']) {
            case 'add':
                $addRoleForm = new AddRoleForm();
                //Crée un nouveau Role
                $role = $addRoleForm->getData();
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
                $roleForm = new RoleForm();
                $idRole = $roleForm->validateIdRole();

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
                $modifyRoleForm = new ModifyRoleForm();
                $role = $modifyRoleForm->getData();

                //Function delete sur l'id de role
                $status = $roleDao->modifyRole($role);

                //Si $statut est executé alors affiche l'id avec msg "supprimé"
                if ($status) {
                    $msg = "Le role à été modifié ";
                }
                //Sinon alors affiche  avec msg "Erreur"
                else {
                    $msg = "Aucun film modifié";
                }

                break;
        }
    } else {
        $msg = "";
    }

    $allRoles = $roleDao->getAll();
    $allFilms = $filmsDao->getAll();
    $allActeurs = $acteursDao->getAll();
    $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
    echo $twig->render('gestion_role.html.twig', [
        'allRoles' => $allRoles,
        'allFilms' => $allFilms,
        'allActeurs' => $allActeurs, 
        'status' => $msg,
        'error' => $error
    ]);
    unset($_SESSION['error']);
}
catch(Exception $e)
{
    $_SESSION['error'] = $e->getMessage();
    $url = './?action=gestion_role';
    header('Location:'.$url);
}