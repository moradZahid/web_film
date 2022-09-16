<?php
include('controllerFunctions.php');

authenticate_automatically();
alterTableRole();

try
{
    //gere connection et les function 
    $filmsDao = new FilmsDAO(); 

    //Si titre ou realisateur est soumis
    if (isset($_POST['titre'])) {   
        $keywords = make_keywords_title();
        if (!$keywords)
        {
            throw new Exception('Element de recherche invalide.');
        }
        $films = $filmsDao->searchFilm($keywords);   

        foreach ($films as $film) {
            $acteurList = $filmsDao->filmActeur($film->get_idFilm());
            $film->set_tabRoles($acteurList);
        }
    
        echo $twig->render('recherche_film.html.twig', ['film' => $films[0], 'films' => array_slice($films, 1)]);
    } else {
        $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
        echo $twig->render('recherche_film.html.twig',[
            'error' => $error
        ]);
    }
    unset($_SESSION['error']);
}
catch(Exception $e)
{
    $_SESSION['error'] = $e->getMessage();
    header('Location: ./');
}