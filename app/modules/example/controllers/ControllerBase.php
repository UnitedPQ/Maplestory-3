<?php

namespace App\Modules\Example\Controllers;

use Phalcon\Mvc\Dispatcher;

use App\Controller;

class ControllerBase extends Controller
{
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        parent::beforeExecuteRoute($dispatcher);

        return TRUE;
    }
}