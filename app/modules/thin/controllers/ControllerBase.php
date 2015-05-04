<?php

namespace App\Modules\Thin\Controllers;

use Phalcon\Mvc\Dispatcher;

use App\Controller;
use App\Models\Thin\Stat;

class ControllerBase extends Controller
{
    protected $loginTypes = array('weibo');

    protected $components = array();

    protected $moduleName = 'thin';

    protected $stat;

    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        parent::beforeExecuteRoute($dispatcher);

        if ($this->auth->isLogined()) {
            $this->stat = Stat::fetch($this->currentUser->id);
            if ($this->stat->weiboDate != DATE_STR)
                $this->stat->drawReset();
        }

        $this->components = (array) $this->moduleConfig->components;

        $this->view->setVars(array(
            'components' => $this->components,
        ));

        return TRUE;
    }
}