<?php

class FilmsForm
{
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
    
    public function validateTitre()
    {
        if (!filter_has_var(INPUT_POST,'titre'))
        {
            throw new Exception('Erreur dans le formulaire.');
        }
        $titre = filter_input(INPUT_POST,'titre',FILTER_SANITIZE_SPECIAL_CHARS);
        if (strlen($titre) == 0)
        {
            throw new Exception('Tous les champs sont obligatoires.');
        }
        return $titre;
    }

    public function validateRealisateur()
    {
        if (!filter_has_var(INPUT_POST,'realisateur'))
        {
            throw new Exception('Erreur dans le formulaire.');
        }
        $realisateur = filter_input(INPUT_POST,'realisateur',FILTER_SANITIZE_SPECIAL_CHARS);
        if (strlen($realisateur) == 0)
        {
            throw new Exception('Tous les champs sont obligatoires.');
        }
        return $realisateur;
    }

    public function validateAffiche()
    {
        if (!filter_has_var(INPUT_POST,'affiche'))
        {
            throw new Exception('Erreur dans le formulaire.');
        }
        $affiche = filter_input(INPUT_POST,'affiche',FILTER_SANITIZE_SPECIAL_CHARS);
        if (strlen($affiche) == 0)
        {
            throw new Exception('Tous les champs sont obligatoires.');
        }
        return $affiche;
    }

    public function validateAnnee()
    {
        if (!filter_has_var(INPUT_POST,'annee'))
        {
            throw new Exception('Erreur dans le formulaire.');
        }
        $annee = filter_input(INPUT_POST,'annee',FILTER_VALIDATE_INT);
        if (strlen($annee) == 0)
        {
            throw new Exception('Tous les champs sont obligatoires.');
        }
        return $annee;
    }
    
}