<?php


class Films
{

    private $_idFilm;
    private $_titre;
    private $_realisateur;
    private $_affiche;
    private $_annee;
    private $_tabRoles;

    public function __construct($idFilm = null, $titre = null, $realisateur = null, $affiche = null, $annee = null, $tabRoles = null)
    {
        if (!is_null($idFilm)) {
            $this->set_idFilm($idFilm);
        }
        $this->set_titre($titre);
        $this->set_realisateur($realisateur);
        $this->set_affiche($affiche);
        $this->set_annee($annee);
        $this->set_tabRoles($tabRoles);
    }


    //Getteur
    public function get_idFilm()
    {
        return $this->_idFilm;
    }

    public function get_titre()
    {
        return $this->_titre;
    }

    public function get_realisateur()
    {
        return $this->_realisateur;
    }

    public function get_affiche()
    {
        return $this->_affiche;
    }

    public function get_annee()
    {
        return $this->_annee;
    }

    public function get_tabRoles()
    {
        return $this->_tabRoles;
    }

    //Setteur

    public function set_titre($_titre)
    {
        $this->_titre = $_titre;
    }

    public function set_affiche($_affiche)
    {
        $this->_affiche = $_affiche;
    }

    public function set_annee($_annee)
    {
        $this->_annee = $_annee;
    }

    public function set_idFilm($_idFilm)
    {
        $this->_idFilm = $_idFilm;
    }

    public function set_realisateur($_realisateur)
    {
        $this->_realisateur = $_realisateur;
    }

    public function set_tabRoles($_tabRoles)
    {
        $this->_tabRoles = $_tabRoles;
    }
}
