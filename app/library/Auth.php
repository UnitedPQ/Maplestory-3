<?php

namespace App;

use Phalcon\DI;
use Phalcon\Mvc\User\Component;

use App\Models\User;

use Weibo\Weibo;

class Auth extends Component
{
    private $_signed;

    private static $_weibo;

    private static $_user;

    public function &weibo()
    {
        if ( ! isset(self::$_weibo)) {
            if ($this->isLogined()) {
                $isPageApp = $this->getIdentity('pageApp');

                if ($isPageApp) {
                    $clientId = $this->getIdentity('clientId');
                } else {
                    $clientId = $this->config->weibo->appKey;
                }

                $clientSecret = $this->config->weibo->appSecret;
                $accessToken = $this->getIdentity('accessToken');

                self::$_weibo = new Weibo($clientId, $clientSecret, $accessToken);
            } else {
                $clientId = $this->config->weibo->appKey;
                $clientSecret = $this->config->weibo->appSecret;

                self::$_weibo = new Weibo($clientId, $clientSecret);
            }
        }
        
        return self::$_weibo;
    }

    public function &user()
    {
        if ( ! isset(self::$_user)) {
            if ($this->isLogined()) {
                $id = $this->getIdentity('id');
                self::$_user = User::findById($id);
            } else {
                self::$_user = NULL;
            }
        }

        return self::$_user;
    }

    public function login($user = NULL, $extra = array()) 
    {
        if ($user instanceof User) {
            $identity = array(
                'id' => $user->id,
                'openId' => $user->openId,
                'type' => $user->type,
                'nickname' => $user->nickname,
                'accessToken' => $user->accessToken,
            );

            $identity = array_merge($extra, $identity);
        } else {
            $identity = NULL;
        }

        $this->session->set('identity', $identity);

        return TRUE;
    }

    public function logout()
    {
        $this->session->destroy();
    }

    public function getIdentity($key = NULL)
    {
        $identity = $this->session->get('identity');

        if (is_array($identity) && ! empty($key))
            return array_get($identity, $key);

        return $identity;
    }

    public function getId()
    {
        return $this->getIdentity('id');
    }

    public function getName()
    {
        return $this->getIdentity('nickname');
    }

    public function isGuest()
    {
        return ! $this->isLogined();
    }

    public function isLogined()
    {
        return (bool) $this->getIdentity('id');
    }

    public function isWeixin()
    {
        return $this->isLogined() && ($this->getIdentity('type') == 'weixin');
    }

    public function isWeibo()
    {
        return $this->isLogined() && ($this->getIdentity('type') == 'weibo');
    }

    public function isPageApp()
    {
        return (bool) $this->getIdentity('pageApp');
    }
}