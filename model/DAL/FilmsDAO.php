<?php

class FilmsDAO extends Dao
{

    //Récupérer toutes les films
    public function getAll()
    {
        //On définit la bdd pour la fonction

        $query = $this->_bdd->prepare("SELECT idFilm, titre, realisateur, affiche, annee FROM films");

        $query->execute();
        $movies = array();

        while ($data = $query->fetch()) {
            $movies[] = new Films($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
        }
        return ($movies);
        // var_dump($data['personnage']);
    }



    //Ajouter un film
    public function add($data)
    {

        $valeurs = ['titre' => $data->get_titre(), 'realisateur' => $data->get_realisateur(), 'affiche' => $data->get_affiche(), 'annee' => $data->get_annee()];
        $requete = 'INSERT INTO films (titre, realisateur, affiche, annee) VALUES (:titre, :realisateur, :affiche, :annee )';
        $insert = $this->_bdd->prepare($requete);
        if (!$insert->execute($valeurs)) {
            //print_r($insert->errorInfo());
            return false;
        } else {
            return true;
        }
    }

    //Récupérer plus d'info sur un film
    public function getOne($idFilm)
    {

        $query = $this->_bdd->prepare('SELECT * FROM films WHERE films.idFilm = :idFilm')->fetch(PDO::FETCH_ASSOC);
        $query->execute(array(':idFilm' => $idFilm));
        $data = $query->fetch();
        $film = new Films($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
        return ($film);
    }

    //Supprimer une offre
    public function deleteOne($idFilm): int
    {
        $query = $this->_bdd->prepare('DELETE FROM films WHERE films.idFilm = :idFilm');
        $query->execute(array(':idFilm' => $idFilm));
        return ($query->rowCount());
    }

    //Recherche film

    public function searchFilm($titre)
    {

        $query = $this->_bdd->prepare('SELECT * FROM films WHERE films.titre = :titre');
        $query->execute(array('titre' => $titre));
        while ($data = $query->fetch()) {
            $movies[] = new Films($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
        }
        return $movies;
    }

    public function filmActeur($idFilm)
    {
        $query = $this->_bdd->prepare('SELECT idFilm, nom, prenom, a.idActeur, peronnage, idRole 
        FROM role r 
        INNER JOIN acteurs a ON r.idActeur = a.idActeur 
        WHERE idFilm = :idFilm');
        $query->execute(array(':idFilm' => $idFilm));
        while ($data = $query->fetch()) {
            $acteurList[] = new Role($data['idFilm'], $data['idRole'], $data['nom'], $data['prenom'], $data['personnage'], $data['idActeur']);
        }
        return $acteurList;
    }
}
