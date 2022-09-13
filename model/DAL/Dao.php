<?php

abstract class Dao
{

    protected $_bdd;

    public function __construct()
    {

        // Connexion Database
        try {
            $this->set_bdd(SPDO::getInstance());
            $this->_bdd->query("SET NAMES UTF8");
        } catch (Exception $e) {
            echo "Problème de connexion à la base de donnée ...";
            die();
        }
    }

    //Récupérer toutes les films

    abstract public function getAll();

    //Récupérer un film
    abstract public function getOne($idFilm);

    //Ajouter un film
    abstract public function add($data);

    public function set_bdd($_bdd)
    {
        $this->_bdd = $_bdd;
    }
}
