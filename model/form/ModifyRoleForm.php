<?php

class ModifyRoleForm extends RoleForm
{
    public function getData()
    {
        $idRole = $this->validateIdRole();
        $idFilm = $this->validateIdFilm();
        $idActeur = $this->validateIdActeur();
        $personnage = $this->validatePersonnage();

        return new Role($personnage,$idRole,$idFilm,null,null,$idActeur);
    }
}