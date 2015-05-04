<?php

namespace App\Modules\Auth\Controllers;

use App\Models\User;
use App\Modules\Auth\Helper;

use Wechat\OAuth;
use Weibo\OAuth as WbOAuth;
use Weibo\Weibo;

class WeixinController extends ControllerBase
{
    public function indexAction()
    {
        if ($this->auth->isWeixin()) {
            $this->redirect();
        } else {
            $appId = $this->config->weixin->appId;
            $appKey = $this->config->weixin->appKey;
            $callback = $this->config->weixin->callback;
            $code = $this->request->getQuery('code', 'trim');
            $scope = $this->request->getQuery('state', 'trim');

            $oauth = new OAuth($appId, $appKey);

            if (empty($code)) {
                $realCallback = $this->url->get('/auth/weixin/', array('state' => 'snsapi_base'));
                $state = base62encode($realCallback);

                $authorizeUrl = $oauth->getAuthorizeURL($callback, 'code', 'snsapi_base', $state);
                $this->response->redirect($authorizeUrl);
            } else {
                try {
                    $token = $oauth->getAccessToken($code);
                    $openId = $token['openid'];
                } catch (\Exception $e) {
                    $this->redirect();
                }

                if (empty($scope) || $scope == 'snsapi_base') {
                    $user = User::findByOpenId($openId);

                    if (empty($user) || empty($user->id) || empty($user->nickname)) {
                        $realCallback = $this->url->get('/auth/weixin/', array('state' => 'snsapi_userinfo'));
                        $state = base62encode($realCallback);

                        $authorizeUrl = $oauth->getAuthorizeURL($callback, 'code', 'snsapi_userinfo', $state);
                        $this->response->redirect($authorizeUrl);
                    } else {
                        $this->auth->login($user);
                        $this->redirect();
                    }
                } else {
                    $userInfo = $oauth->getUserInfo($openId);

                    if (empty($userInfo['errcode'])) {
                        $user = Helper::weixinUser($openId, $userInfo);

                        $user->accessToken = $token['access_token'];
                        $user->save();
                        $this->auth->login($user);
                    }

                    $this->redirect();
                }
            }
        }
    }

    public function toWeiboAction()
    {
        if ($this->auth->isWeibo()) {
            $this->redirect();
        } else {
            if ($this->userAgent->isWeixin()) {
                $code = $this->request->getQuery('code', 'trim');
                $state = $this->request->getQuery('state', 'trim');

                /* 微信授权 */
                $wxAppId = $this->config->weixin->appId;
                $wxAppKey = $this->config->weixin->appKey;
                $wxCallback = $this->config->weixin->callback;

                $wxAuth = new OAuth($wxAppId, $wxAppKey);

                /* 微博授权 */
                $wbAppKey = $this->config->weibo->appKey;
                $wbAppSecret = $this->config->weibo->appSecret;
                
                $wbAuth = new WbOAuth($wbAppKey, $wbAppSecret);

                if (empty($code)) {
                    $realCallback = $this->url->get('/auth/weixin/toWeibo/', array('state' => 'weixin'));
                    $state = base62encode($realCallback);

                    $authorizeUrl = $wxAuth->getAuthorizeURL($wxCallback, 'code', 'snsapi_base', $state);
                    $this->response->redirect($authorizeUrl);
                } elseif ($state == 'weixin') { //微信处理Code
                    $openId = NULL;
                    try {
                        $token = $wxAuth->getAccessToken($code);
                        $openId = $token['openid'];
                    } catch (\Exception $e) {
                        $this->redirect();
                    }

                    if (empty($openId))
                        $this->redirect();

                    $user = Helper::weixinUser($openId);

                    if (empty($user->weiboId)) {
                        $this->auth->login($user);
                        $this->redirectWeiboAuthorizeUrl($wbAuth);
                    } else {
                        $weiboUser = $user->weiboUser;
                        $tokenInfo = $wbAuth->getTokenInfo($weiboUser->accessToken);
                        if ($tokenInfo['error_code'] || $tokenInfo['expire_in'] <= 0) {
                            $this->auth->login($user);
                            $this->redirectWeiboAuthorizeUrl($wbAuth);
                        } else {
                            $this->auth->login($weiboUser);
                            $this->redirect();
                        }
                    }
                } elseif ($state == 'weibo') { //微博处理Code
                    if ( ! $this->auth->isWeixin())
                        $this->redirect();

                    $keys = array();
                    $keys['code'] = $code;
                    $keys['redirect_uri'] = $this->url->get('/auth/weixin/toWeibo/');
                    try {
                        $token = $wbAuth->getAccessToken('code', $keys) ;
                    } catch (\Exception $e) {
                        $this->redirectAuthorizeUrl($wbAuth);
                    }

                    if ($token) {
                        $openId = $token['uid'];
                        $accessToken = $token['access_token'];

                        $weibo = new Weibo($wbAppKey, $wbAppSecret, $accessToken);
                        $userInfo = $weibo->show_user_by_id($openId);

                        if (empty($userInfo['error_code'])) {
                            $user = Helper::weiboUser($openId, $userInfo);

                            $user->accessToken = $accessToken;
                            $user->save();

                            $authUser = $this->auth->user();
                            if (empty($authUser->weiboId)) {
                                $authUser->weiboId = $user->id;
                                $authUser->save();
                            }

                            $this->auth->login($user);
                        }

                        $this->redirect();
                    }
                } else {
                    $this->redirect();
                }
            } else {
                $this->redirect();
            }
        }
    }

    private function redirectWeiboAuthorizeUrl($o)
    {
        $isMobile = $this->userAgent->isMobile();
        $authorizeUrl = $o->getAuthorizeURL($this->url->get('/auth/weixin/toWeibo/'), 'code', 'weibo', $isMobile ? 'mobile' : 'default');
        $this->response->redirect($authorizeUrl);
        $this->response->send();
    }
}