<?php

namespace App\View;

use App\Utils\Navigation\SessionData;

class View{
    private $template;
    private $data;
    private $status;

    public function __construct($template, $data, $status)
    {
        $this->template = $template;
        $this->data     = $data; 
        $this->status   = $status;
    }
    public function render()
    {
        $flashes = [];
        if(SessionData::existFlash())
            $flashes   = SessionData::getFlashes();
        require "./../template/layouts/header.html.php";
        require './../template/'.$this->template.'.html.php';
        require "./../template/layouts/footer.html.php";
    }

    private function userLogged():bool
    {
        return SessionData::userLogged();
    }
}