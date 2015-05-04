<?php

namespace App;

class Hook
{
    protected $controller;

    protected $currentUser;

    protected $di;

    public function __construct($controller = NULL)
    {
        if ( ! empty($controller)) {
            $this->setController($controller);
        }
    }

    public function setController($controller)
    {
        if ($controller instanceof Controller) {
            $this->controller = $controller;
            $this->currentUser = $this->controller->getCurrentUser();
            $this->di = $this->controller->getDI();
        }
    }
}