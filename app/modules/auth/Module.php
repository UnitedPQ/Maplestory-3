<?php

namespace App\Modules\Auth;

use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;

use App\Module as ModuleBase;

class Module extends ModuleBase
{
    public $id = 'auth';
}