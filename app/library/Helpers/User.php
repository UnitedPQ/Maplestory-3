<?php

namespace App\Helpers;

use Phalcon\DI;

use App\Models\User as UserModel;

class User
{
    public static function weibo($userId, $refresh = FALSE)
    {
        $user = UserModel::findFirst(array(
            'conditions' => 'openId = :openId: AND type = "weibo"',
            'bind' => array('openId' => $userId),
        ));

        if ($refresh || empty($user) || empty($user->id)) {
            $di = DI::getDefault();
            $auth = $di->getShared('auth');
            $weibo = $auth->weibo();
            $userInfo = $weibo->show_user_by_id($userId);

            if (empty($userInfo['error_code'])) {
                if (empty($user) || empty($user->id)) {
                    $user = new UserModel;
                    $user->openId = $userId;
                }
                $user->nickname = $userInfo['name'];
                $user->avatar = $userInfo['avatar_large'];
                $user->type = 'weibo';

                $user->save();
            }
        }

        return $user;
    }

    public static function weixin($openId)
    {
        $user = UserModel::findFirst(array(
            'conditions' => 'openId = :openId: AND type = "weixin"',
            'bind' => array('openId' => $openId),
        ));

        return $user;
    }
}