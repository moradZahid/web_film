<?php

class ModifyFilmsForm extends FilmsForm
{
    public function getData()
    {
        $idFilm = $this->validateIdFilm();
        $titre = $this->validateTitre();
        $realisateur = $this->validateRealisateur();
        $affiche = $this->validateAffiche();
        $annee = $this->validateAnnee();

        return new Films($idFilm,$titre,$realisateur,$affiche,$annee);
    }
}