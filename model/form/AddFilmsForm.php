<?php

class AddFilmsForm extends FilmsForm
{
    public function getData()
    {
        $titre = $this->validateTitre();
        $realisateur = $this->validateRealisateur();
        $affiche = $this->validateAffiche();
        $annee = $this->validateAnnee();

        return new Films(null,$titre,$realisateur,$affiche,$annee);
    }
}