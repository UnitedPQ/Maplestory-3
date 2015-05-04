<?php

namespace App\Modules\Prize\Controllers;

use Phalcon\Mvc\View;

use App\Helpers\Prize as PrizeHelper;
use App\Models\DrawResult;

class IndexController extends ControllerBase
{
    protected $requireLogin = FALSE;

    public function indexAction()
    {
        if ($this->request->isAjax()) {
            $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        }

        $prizeList = PrizeHelper::getLuckList($this->_module, $this->_activityId);

        $drawList = DrawResult::find(array(
            'conditions' => 'module = :module: AND activityId = :activityId: AND isLuck = 1',
            'bind' => array(
                'module' => $this->_module,
                'activityId' => $this->_activityId,
            ),
        ));

        $list = array();
        foreach ($drawList as $drawResult) {
            if ( ! isset($list[$drawResult->prizeId]))
                $list[$drawResult->prizeId] = array();
            $list[$drawResult->prizeId][] = $drawResult;
        }

        $this->view->setVars(array(
            'prizeList' => $prizeList,
            'drawList' => $drawList,
            'list' => $list,
        ))->pick('prize/index');
    }
}