<?php

namespace App\Modules\Newyear\Controllers;

use Phalcon\Mvc\View;
use App\Models\Newyear\Msg;

class IndexController extends ControllerBase
{
    protected $requireLogin = TRUE;

    public function indexAction()
    {
        $this->view->setVars([
            'page' => 'index',
        ]);
    }

    public function saveAction()
    {
        if ($this->request->isPost()) {
            $name = $this->request->getPost('name', 'trim');

            if (empty($name)) {
                $this->json->error('请先输入您的名字');
            } else {
                $num = mt_rand(1, 100000);
                $lyrics = (array) $this->moduleConfig->lyrics;
                $lyricNo = $num % count($lyrics) + 1;

                $msg = new Msg;
                $msg->userId = $this->currentUser->id;
                $msg->nickname = $this->currentUser->nickname;
                $msg->name = $name;
                $msg->lyricNo = $lyricNo;

                if ($msg->save()) {
                    $this->json->set('msgId', $msg->id);
                    $this->json->set('lyricNo', $msg->lyricNo);
                    $this->json->set('shareUrl', $this->url->get('/newyear/', array('mid' => $msg->id)));
                    $this->json->set('shareTitle', $msg->nickname.'的2015音乐运势是：'.$lyrics[$lyricNo]);
                    $this->json->success('OK');
                } else {
                    $this->json->error('出错了，请稍后重试');
                }
            }
        } else {
            die('Access Denied.');
        }
    }
}