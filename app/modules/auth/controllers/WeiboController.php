<?php

namespace App\Modules\Auth\Controllers;

use Weibo\OAuth;
use Weibo\Weibo;

use App\Modules\Auth\Helper;

class WeiboController extends ControllerBase
{
    public function indexAction()
    {
        if ($this->auth->isWeibo()) {
            $this->redirect();
        } else {
            $appKey = $this->config->weibo->appKey;
            $appSecret = $this->config->weibo->appSecret;

            $code = $this->request->getQuery('code', 'trim');

            $o = new OAuth($appKey, $appSecret);

            if (empty($code)) {
                $this->redirectAuthorizeUrl($o);
            } else {
                $keys = array();
                $keys['code'] = $code;
                $keys['redirect_uri'] = $this->url->get('/auth/weibo/');
                try {
                    $token = $o->getAccessToken('code', $keys) ;
                } catch (\Exception $e) {
                    $this->redirectAuthorizeUrl($o);
                }

                if ($token) {
                    $openId = $token['uid'];
                    $accessToken = $token['access_token'];

                    $weibo = new Weibo($appKey, $appSecret, $accessToken);
                    $userInfo = $weibo->show_user_by_id($openId);

                    if (empty($userInfo['error_code'])) {
                        $user = Helper::weiboUser($openId, $userInfo);

                        $user->accessToken = $accessToken;
                        $user->save();

                        $this->auth->login($user);
                    }

                    $this->redirect();
                }
            }
        }
    }

    private function redirectAuthorizeUrl($o)
    {
        $isMobile = $this->userAgent->isMobile();
        $authorizeUrl = $o->getAuthorizeURL($this->url->get('/auth/weibo/'), 'code', NULL, $isMobile ? 'mobile' : 'default');
        $this->response->redirect($authorizeUrl);
        $this->response->send();
    }
}