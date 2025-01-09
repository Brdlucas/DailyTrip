<?php

class Router
{
    // Récupération de l'URL actuelle
    private string $url; // URL actuelle
    private string $path; // Supprimer le slash de la fin

    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI']; // URL de la requête
        $this->path = parse_url($this->url, PHP_URL_PATH); // chemin de la requête
        $this->path = rtrim($this->path, '/'); // chemin de la requête
    }
    // METHODES (FONCTIONS)

    /**
     * Méthode (fonction) pour démarrer le routage 
     * Permet de lancer l'écoute sur l'index
     */
    public function start()
    {
        $this->goTo();
    }

    /**
     * Méthode (fonction) permettant de vérifirier si l'URL demandée
     * existe puis de rendre la page correspondante à la demande
     * @return void
     */
    public function goTo()
    {
        $view = './src/views' . $this->path . '.html.php';
        if (file_exists($view)) {

            require_once $view;
        } else {

            require_once './src/views/404.html.php';
        }
    }
}




 // public function goTo(?string $ref)
    // {

    //     // Sécurité pour toujours avoir /home dans les suivants :
    //     if ($this->path === '' || $this->path === '/index.php') {
    //         $this->path = '/home';
    //     }

    //     switch ($this->path) {
    //         case '/home':
    //             require_once '../views/home.html.php';
    //             break;

    //         case '/trips':
    //             require_once '../views/trips.html.php';
    //             break;

    //         case "/trip/$ref":
    //             require_once '../views/trips.html.php';
    //             break;

    //         case '/add':
    //             require_once '../views/add.html.php';
    //             break;

    //         case '/terms':
    //             require_once 'src/views/terms.php';
    //             break;

    //         default:
    //             header("HTTP/1.0 404 Not Found");
    //             require_once 'src/views/404.php';
    //             break;
    //     }
    // }