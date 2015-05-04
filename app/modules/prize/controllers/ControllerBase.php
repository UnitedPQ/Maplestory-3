<?php

namespace App\Modules\Prize\Controllers;

use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;

use App\Controller;

class ControllerBase extends Controller
{
    protected $_module;

    protected $_activityId = 0;
    
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        parent::beforeExecuteRoute($dispatcher);

        $this->_module = $this->request->get('module', 'trim');
        $this->_activityId = $this->request->get('activityId', 'int');

        if (empty($this->_module))
            die('Access Denied.');
        $this->_activityId = is_int($this->_activityId) ? $this->_activityId : 0;

        $viewsBaseDir = $this->config->application->modulesDir . $this->_module . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;
        if ($this->userAgent->isMobile() && empty($this->noWap) && is_dir($viewsBaseDir . 'mobile')) {
            $viewsDir = $viewsBaseDir . 'mobile';
        } else {
            $viewsDir = $viewsBaseDir . 'default';
        }
        $this->view->setViewsDir($viewsDir);

        return TRUE;
    }
}