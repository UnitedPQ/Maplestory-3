<?php

namespace App\Modules\Prize\Controllers;

use Phalcon\Mvc\View;

use App\Models\DrawResult;

class MyController extends ControllerBase
{
    protected $requireLogin = TRUE;
    
    public function indexAction()
    {
        if ($this->request->isAjax()) {
            $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        }

        $list = DrawResult::find(array(
            'conditions' => 'module = :module: AND activityId = :activityId: AND userId = :userId: AND isLuck = 1',
            'bind' => array(
                'module' => $this->_module,
                'activityId' => $this->_activityId,
                'userId' => $this->currentUser->id,
            ),
        ));

        $this->view->setVars(array(
            'list' => $list,
        ))->pick('prize/my');
    }
}