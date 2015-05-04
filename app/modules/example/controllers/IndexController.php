<?php

namespace App\Modules\Example\Controllers;

use Phalcon\Mvc\View;

class IndexController extends ControllerBase
{
    protected $requireLogin = TRUE;

    public function indexAction()
    {
        $this->response->setContent('OK');
        $this->response->send();
    }
}