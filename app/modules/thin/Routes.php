<?php

namespace App\Modules\Thin;

use App\Routes as RoutesBase;

class Routes extends RoutesBase
{
    public $module = 'thin';

    public function initialize()
    {
        parent::initialize();

        $this->add('/intro', array(
            'controller' => 'index',
            'params' => 'index',
            'template' => 'intro',
        ));
    }
}