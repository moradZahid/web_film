<?php

class ActeursDAO extends Dao
{

    //Récupérer toutes les Acteurs
    public function getAll()
    {
        //On définit la bdd pour la fonction

        $query = $this->_bdd->prepare("SELECT a.idActeur, a.nom, a.prenom FROM acteurs AS a");
        $query->execute();
        $actors = array();


        while ($data = $query->fetch()) {
            $actors[] = new Acteurs($data['idActeur'], $data['nom'], $data['prenom']);
        }
        return ($actors);
        var_dump($actors);
    }



    //Ajouter un acteur
    public function add($data)
    {

        $valeurs = ['nom' => $data->get_nom(), 'prenom' => $data->get_prenom()];
        $requete = 'INSERT INTO acteurs (nom, prenom) VALUES (:nom, :prenom)';
        $insert = $this->_bdd->prepare($requete);
        if (!$insert->execute($valeurs)) {
            return false;
        } else {
            return true;
        }
    }

    //Récupérer plus d'info sur un acteur
    public function getOne($idActeur)
    {

        $query = $this->_bdd->prepare('SELECT * FROM acteurs WHERE acteurs.idActeur = :idActeurs')->fetch(PDO::FETCH_ASSOC);
        $query->execute(array(':idActeur' => $idActeur));
        $data = $query->fetch();
        $acteur = new Acteurs($data['idActeur'], $data['nom'], $data['prenom']);
        return ($acteur);
    }

    //Supprimer un acteur
    public function deleteOne($idActeur): int
    {
        $query = $this->_bdd->prepare('DELETE FROM acteurs WHERE acteurs.idActeur = :idActeur');
        $query->execute(array(':idActeur' => $idActeur));
        return ($query->rowCount());
    }
}
