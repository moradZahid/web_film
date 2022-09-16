<?php

class RoleForm
{
    public function validateIdRole()
    {
        if (!filter_has_var(INPUT_POST,'idRole'))
        {
            throw new Exception('Erreur dans le formulaire.');
        }
        $idRole = filter_input(INPUT_POST,'idRole',FILTER_VALIDATE_INT);
        if (!$idRole)
        {
            throw new Exception('Erreur dans le formulaire.');
        }
        return $idRole;  
    }
    
    public function validateIdFilm()
    {
        if (!filter_has_var(INPUT_POST,'idFilm'))
        {
            throw new Exception('Erreur dans le formulaire.');
        }
        $idFilm = filter_input(INPUT_POST,'idFilm',FILTER_VALIDATE_INT);
        if (!$idFilm)
        {
            throw new Exception('Erreur dans le formulaire.');
        }
        return $idFilm;  
    }

    public function validateIdActeur()
    {
        if (!filter_has_var(INPUT_POST,'idActeur'))
        {
            throw new Exception('Erreur dans le formulaire.');
        }
        $idActeur = filter_input(INPUT_POST,'idActeur',FILTER_VALIDATE_INT);
        if (!$idActeur)
        {
            throw new Exception('Erreur dans le formulaire.');
        }
        return $idActeur;  
    }
    
    public function validatePersonnage()
    {
        if (!filter_has_var(INPUT_POST,'personnage'))
        {
            throw new Exception('Erreur dans le formulaire.');
        }
        $personnage = filter_input(INPUT_POST,'personnage',FILTER_SANITIZE_SPECIAL_CHARS);
        if (strlen($personnage) == 0)
        {
            throw new Exception('Tous les champs sont obligatoires.');
        }
        return $personnage;
    }
}