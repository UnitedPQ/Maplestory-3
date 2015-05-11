<?php

namespace App\Modules\DdG1fspZ\Controllers;

use Phalcon\Mvc\Dispatcher;

use App\Controller;

class ControllerBase extends Controller
{
    //protected $requireLogin = TRUE;

    protected $noWap = TRUE;
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        parent::beforeExecuteRoute($dispatcher);
        return TRUE;
    }
}