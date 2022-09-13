<?php


class Acteurs
{

    private $_idActeur;
    private $_nom;
    private $_prenom;

    public function __construct($idActeur = null, $nom = null, $prenom = null)
    {
        $this->_idActeur = ($idActeur);
        $this->_nom = ($nom);
        $this->_prenom = ($prenom);
    }


    //Getteur
    public function get_idActeur()
    {
        return $this->_idActeur;
    }

    public function get_nom()
    {
        return $this->_nom;
    }


    public function get_prenom()
    {
        return $this->_prenom;
    }

    //Setteur

    public function set_nom($_nom)
    {
        $this->_nom = $_nom;
    }

    public function set_idActeur($_idActeur)
    {
        $this->_id = $_idActeur;
    }

    public function set_prenom($_prenom)
    {
        $this->_id = $_prenom;
    }
}
