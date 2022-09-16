<?php

class AddRoleForm extends RoleForm
{
    public function getData()
    {
        $idFilm = $this->validateIdFilm();
        $idActeur = $this->validateIdActeur();
        $personnage = $this->validatePersonnage();

        return new Role($personnage,null,$idFilm,null,null,$idActeur);
    }
}