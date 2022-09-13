<?php

function check_idUser()
{
    if (!filter_has_var(INPUT_GET,'id'))
    {
        throw new Exception('Erreur lors de la suppression.');
    }
    $idUser = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
    if (!$idUser)
    {
        throw new Exception('Erreur lors de la suppression.');
    }
    return $idUser;
}    
