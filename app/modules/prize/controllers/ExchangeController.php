<?php

namespace App\Modules\Prize\Controllers;

use Phalcon\Mvc\View;

use App\Models\DrawResult;
use App\Models\Exchange;

class ExchangeController extends ControllerBase
{
    protected $requireLogin = TRUE;
    
    public function indexAction()
    {
        if ($this->request->isAjax()) {
            $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        }
            
        $id = $this->dispatcher->getParam('id', 'int');
        $result = DrawResult::findById($id);
        $canExchange = $result && ($result->userId == $this->currentUser->id);

        /*if ($canExchange && $result->prize->isCoupon()) {
            $coupon = $result->coupon;
            if (empty($coupon) || empty($coupon->id)) {
                $coupon = new Coupon();
                if ($coupon->exchange($result->id))
                    $coupon = Coupon::findByResultId($result->id);
            }
            if ($coupon->id && $coupon->resultId) {
                $result->exchange = 1;
                $result->exchangeTime = TIMESTAMP;
                $result->couponId = $coupon->id;
                $result->save();
            }
        }*/

        if ($canExchange && $this->request->isPost() && ! $result->exchange) {
            $name = $this->request->getPost('name', 'trim');
            $mobile = $this->request->getPost('mobile', 'trim');
            $address = $this->request->getPost('address', 'trim');
            $idcard = $this->request->getPost('idcard', 'trim');

            if ($result->deadline > 0 && $result->deadline < TIMESTAMP) {
                $this->json->error('兑奖时间已过，不能兑奖！');
            } elseif (empty($name) || empty($mobile) || empty($idcard)) {
                $this->json->error('请认真填写必填项目！');
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
                    $this->json->success('兑奖成功，奖品将在15个工作日内安排寄送！');
                } else {
                    $this->json->error('兑奖失败，请稍后重试！');
                }
            }
        }

        $this->view->setVars(array(
            'canExchange' => $canExchange,
            'result' => $result,
        ))->pick('prize/exchange');
    }
}