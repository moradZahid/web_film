<?php

class ActeursForm
{
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
    
    public function validateNom()
    {
        if (!filter_has_var(INPUT_POST,'nom'))
        {
            throw new Exception('Erreur dans le formulaire.');
        }
        $nom = filter_input(INPUT_POST,'nom',FILTER_SANITIZE_SPECIAL_CHARS);
        if (strlen($nom) == 0)
        {
            throw new Exception('Tous les champs sont obligatoires.');
        }
        return $nom;
    }

    public function validatePrenom()
    {
        if (!filter_has_var(INPUT_POST,'prenom'))
        {
            throw new Exception('Erreur dans le formulaire.');
        }
        $prenom = filter_input(INPUT_POST,'prenom',FILTER_SANITIZE_SPECIAL_CHARS);
        if (strlen($prenom) == 0)
        {
            throw new Exception('Tous les champs sont obligatoires.');
        }
        return $prenom;
    }
}