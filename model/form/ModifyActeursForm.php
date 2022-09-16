<?php

class ModifyActeursForm extends ActeursForm
{
    public function getData()
    {
        $idActeur = $this->validateIdActeur();
        $nom = $this->validateNom();
        $prenom = $this->validatePrenom();

        return new Acteurs($idActeur,$nom,$prenom);
    }
}