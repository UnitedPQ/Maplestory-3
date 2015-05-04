<?php

namespace App;

use Phalcon\Mvc\Router\Group;

class Routes extends Group
{
    public $module = NULL;

    public $prefix = NULL;

    public $addDefault = TRUE;

    public function initialize()
    {
        if ( ! empty($this->module)) {
            $this->setPaths(array(
                'module' => $this->module,
            ));
        }

        if ( ! empty($this->prefix)) {
            $this->setPrefix($this->prefix);
        } elseif ( ! empty($this->module)) {
            $this->setPrefix('/' . $this->module);
        }

        if ($this->addDefault) {
            $this->add('/?', array(
                'controller' => 'index',
                'action' => 'index',
            ));

            $this->add('/([\w\d]+)((/id/[\w\d]+)?(/page/\d+)?)?(\..+)?', array(
                'controller' => 1,
                'params' => 2,
            ));

            $this->add('/([\w\d]+)/([\w\d]+)((/id/[\w\d]+)?(/page/\d+)?)?(\..+)?', array(
                'controller' => 1,
                'action' => 2,
                'params' => 3,
            ));

            $this->add('((/id/[\w\d]+)?(/page/\d+)?)?(\..+)?', array(
                'controller' => 'index',
                'action' => 'index',
                'params' => 1,
            ));
        }
    }
}