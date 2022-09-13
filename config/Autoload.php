<?php

/**
 * Class Autoloader
 */
class Autoloader
{

    /**
     * Enregistre notre autoloader
     */
    public static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclue le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    public static function autoload($class)
    {
        if (file_exists(_MODEL_ . 'BO/' . $class . '.php')) {
            require _MODEL_ . 'BO/' . $class . '.php';
        }
        if (file_exists(_MODEL_ . 'DAL/' . $class . '.php')) {
            require _MODEL_ . 'DAL/' . $class . '.php';
        }
        if (file_exists(_MODEL_.'form/'.$class.'.php' ))
        {
            require(_MODEL_.'form/'.$class.'.php');
        }
    }
}

// Load Twig autoloader
require_once './view/web/tools/vendor/autoload.php';
