<?php

namespace App\Modules\Auth\Controllers;

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $clientId = $this->request->getQuery('cid', 'trim');
        $userId = $this->request->getQuery('viewer', 'trim');
        $subAppKey = $this->request->getQuery('sub_appkey', 'trim');
        $tokenString = $this->request->getQuery('tokenString', 'trim');

        $appKey = $this->config->weibo->appKey;
        $redirectUri = sprintf('http://e.weibo.com/%d/app_%d', $clientId, $appKey);
        $isMobile = $this->userAgent->isMobile();

        $this->view->setVars(array(
            'clientId' => $clientId,
            'userId' => $userId,
            'subAppKey' => $subAppKey,
            'tokenString' => $tokenString,
            'redirectUri' => $redirectUri,
            'isMobile' => $isMobile,
        ));
    }
}