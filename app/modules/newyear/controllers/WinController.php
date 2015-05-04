<?php

namespace App\Modules\Newyear\Controllers;

use Phalcon\Mvc\View;
use App\Helpers\Prize as PrizeHelper;
use App\Models\DrawResult;
use App\Models\Exchange;

class WinController extends ControllerBase
{
    protected $requireLogin = TRUE;

    public function indexAction()
    {
        $prizeList = PrizeHelper::getLuckList($this->moduleName);

        $drawList = DrawResult::find(array(
            'conditions' => 'module = :module: AND activityId = 0 AND isLuck = 1',
            'bind' => array(
                'module' => $this->moduleName,
            ),
        ));

        $list = array();
        foreach ($drawList as $drawResult) {
            if ( ! isset($list[$drawResult->prizeId]))
                $list[$drawResult->prizeId] = array();
            $list[$drawResult->prizeId][] = $drawResult;
        }

        $this->view->setVars([
            'page' => 'win',
            'prizeList' => $prizeList,
            'drawList' => $drawList,
            'list' => $list,
        ]);
    }

    public function doAction()
    {
        if ($this->request->isPost()) {
            if ($this->moduleConfig->startTime > TIMESTAMP) {
                $this->json->error('活动即将开始！');
            } elseif ($this->moduleConfig->endTime < TIMESTAMP) {
                $this->json->error('活动已结束！');
            } elseif ($this->stat->drawUse()) {
                $this->stat->refresh();

                $prize = PrizeHelper::raffle(array(
                    'module' => $this->moduleName,
                    'startTime' => $this->moduleConfig->startTime,
                    'endTime' => $this->moduleConfig->endTime,
                ));

                if ($prize->isLuck) {
                    $this->json->success('恭喜你获得一' . $prize->unit . $prize->name);
                } else {
                    $this->json->success('很遗憾，你没有中奖~');
                }
                
                $this->json->set('id', $prize->id);
                $this->json->set('isLuck', $prize->isLuck);
                $this->json->set('itemId', $prize->extra('itemId'));
                $this->json->set('angle', $prize->extra('angle'));
            } else {
                $message = '您今天的机会已经用完！';

                $this->json->error($message);
            }

            $this->json->set('drawLeft', $this->stat->drawLeft);
        } else {
            die('Access Denied.');
        }
    }

    public function exchangeAction()
    {
        $result = DrawResult::findFirst(array(
            'conditions' => 'module = :module: AND activityId = 0 AND userId = :userId: AND isLuck = 1',
            'bind' => array(
                'module' => $this->moduleName,
                'userId' => $this->currentUser->id,
            ),
        ));

        if (empty($result) || empty($result->id)) {
            $this->json->error('很遗憾，你没有中奖！');
        } elseif ($result->exchange) {
            $this->json->error('你的奖品已兑换！');
        } else {
            if ($this->request->isPost()) {
                $name = $this->request->getPost('name', 'trim');
                $mobile = $this->request->getPost('mobile', 'trim');
                $address = $this->request->getPost('address', 'trim');
                $idcard = $this->request->getPost('idcard', 'trim');

                if ($result->deadline > 0 && $result->deadline < TIMESTAMP) {
                    $this->json->error('兑奖时间已过，不能兑奖！');
                } elseif (empty($name) || empty($address) || empty($mobile) || empty($idcard)) {
                    $this->json->error('请填写完整信息！');
                } else{
                    $exchange = new Exchange;
                    $exchange->userId = $this->currentUser->id;
                    $exchange->nickname = $this->currentUser->nickname;
                    $exchange->module = $result->module;
                    $exchange->activityId = $result->activityId;
                    $exchange->resultId = $result->id;
                    $exchange->prizeId = $result->prizeId;
                    $exchange->name = $name;
                    $exchange->mobile = $mobile;
                    $exchange->idcard = $idcard;
                    $exchange->address = $address;
                    $exchange->note = NULL;
                    $exchange->extra = NULL;
                    $exchange->ipAddress = $this->request->getClientAddress();;
                    $exchange->userAgent = $this->request->getUserAgent();;

                    $result->exchange = 1;
                    $result->exchangeTime = TIMESTAMP;

                    if ($exchange->save() && $result->save()) {
                        $this->json->success('兑奖成功！');
                    } else {
                        $this->json->error('兑奖失败，请重试！');
                    }
                }
            } else {
                $this->json->success('<p>恭喜你获得了</p><p>'.$result->prize->name.'</p>');
            }
        }
    }
}