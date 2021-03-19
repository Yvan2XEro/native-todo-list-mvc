<?php

namespace App\Controller;

use App\View\View;
use App\Utils\CustomTools\UrlTools;
use App\Utils\Navigation\SessionData;
use App\Kernel\Persistance\EntityManager;

class Controller{

    protected $entityManager;

    public function __construct()
    {
        $this->entityManager =  new EntityManager();
    }

    protected function render(string $template, $data=[], int $status=200)
    {
        $view = new View($template, $data, $status);
        $view->render();
    }

    protected function redirect(string $location)
    {
        UrlTools::redirect($location);
    }
    protected function json(int $status, $data)
    {
        http_response_code($status);
        header("content-type: application/json");
        echo json_encode($data);
    }


    protected function authFireWall()
    {
        if(!SessionData::userLogged())
            UrlTools::redirect("/login");
    }
}
// 200 Succès
// 301 Redirection permanente
// 302 Redirection temporaire
// 401 Utilisateur non authentifié
// 403 Accès refusé
// 404 Page non trouvée
// 500 Erreur serveur
// 504 Le serveur n’a pas répondu