<?php

namespace App\Modules\Thin\Controllers;

use Phalcon\Mvc\View;

class IndexController extends ControllerBase
{
    protected $requireLogin = FALSE;

    public function indexAction()
    {
        $template = $this->dispatcher->getParam('template');
        if (empty($template))
            $template = 'index';

        $template = 'index/' . $template;

        $this->view->pick($template);
    }
}