<?php

namespace App\Modules\Newyear\Controllers;

use Phalcon\Mvc\Dispatcher;

use App\Controller;
use App\Models\Newyear\Msg;
use App\Models\Newyear\Stat;

class ControllerBase extends Controller
{
    protected $loginTypes = array('weixin');

    protected $noWap = TRUE;

    protected $stat;

    protected $msg;

    protected $lyrics;

    protected $moduleName = 'newyear';

    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        if (empty($_SERVER['vivo'])) {
            $this->loginTypes = array('weixin', 'weibo');
        }

        parent::beforeExecuteRoute($dispatcher);

        $this->stat = Stat::fetch($this->currentUser->id);
        $this->view->setVar('stat', $this->stat);

        $today = date('Y-m-d');
        if ($this->stat->lastDate != $today) {
            $this->stat->drawReset();
        }

        $msgId = $this->request->getQuery('mid', 'int');
        if ($msgId) {
            $this->msg = Msg::findFirst($msgId);
        } else {
            $this->msg = Msg::findLatest($this->currentUser->id);
        }
        $this->view->setVar('msg', $this->msg);

        $self = $this->msg && ($this->msg->userId == $this->currentUser->id);
        $this->view->setVar('self', $self);

        $this->lyrics = (array) $this->moduleConfig->lyrics;
        $this->view->setVar('lyrics', $this->lyrics);

        $to = $this->request->getQuery('to', 'trim');
        $forceIndex = $to == 'index';
        $this->view->setVar('forceIndex', $forceIndex);

        return TRUE;
    }
}