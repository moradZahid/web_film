<?php

class AddActeursForm extends ActeursForm
{
    public function getData()
    {
        $nom = $this->validateNom();
        $prenom = $this->validatePrenom();

        return new Acteurs(null,$nom,$prenom);
    }
}