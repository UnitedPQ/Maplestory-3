<?php

namespace App\Modules\Example;

use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;

use App\Module as ModuleBase;

class Module extends ModuleBase
{
    public $id = 'example';
}