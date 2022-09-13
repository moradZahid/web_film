<?php


class Role
{

    private $_personnage;
    private $_idRole;
    private $_idFilm;
    private $_nom;
    private $_prenom;
    private $_idActeur;


    public function __construct($personnage = null, $idRole = null, $idFilm = null, $nom = null, $prenom = null, $idActeur = null)
    {
        $this->_personnage = ($personnage);
        $this->_idRole = ($idRole);
        $this->_idFilm = ($idFilm);
        $this->_nom = ($nom);
        $this->_prenom = ($prenom);
        $this->_idActeur = ($idActeur);
    }


    //Getteur
    public function get_idRole()
    {
        return $this->_idRole;
    }

    public function get_idFilm()
    {
        return $this->_idFilm;
    }


    public function get_personnage()
    {
        return $this->_personnage;
    }

    public function get_nom()
    {
        return $this->_nom;
    }

    public function get_prenom()
    {
        return $this->_prenom;
    }

    public function get_idActeur()
    {
        return $this->_idActeur;
    }
    //Setteur

    public function set_personnage($_personnage)
    {
        $this->_personnage = $_personnage;
    }

    public function set_idRole($_idRole)
    {
        $this->_idRole = $_idRole;
    }
    public function set_idFilm($_idFilm)
    {
        $this->_idFilm = $_idFilm;
    }

    public function set_nom($_nom)
    {
        $this->_nom = $_nom;
    }

    public function set_prenom($_prenom)
    {
        $this->_prenom = $_prenom;
    }

    public function set_idActeur($_idActeur)
    {
        $this->_idActeur = $_idActeur;
    }
}
