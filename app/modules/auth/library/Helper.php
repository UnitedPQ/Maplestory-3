<?php

namespace App\Modules\Auth;

use App\Helpers\HelperBase;
use App\Models\User;

class Helper extends HelperBase
{
    public static function weixinUser($openId, $userInfo = array())
    {
        return self::user($openId, 'weixin', $userInfo);
    }

    public static function weiboUser($openId, $userInfo = array())
    {
        return self::user($openId, 'weibo', $userInfo);
    }

    public static function user($openId, $type = 'weibo', $userInfo = array())
    {
        $user = User::findByOpenId($openId);

        if (empty($user) || empty($user->id)) {
            $user = new User;
            $user->openId = $openId;
            $user->type = $type;
        }

        if (empty($userInfo)) {
            $user->save();
            @$user->createStatus();
            return $user;
        }

        if ($type == 'weixin') {
            $nickname = array_get($userInfo, 'nickname');
            $avatar = array_get($userInfo, 'headimgurl');
            $country = array_get($userInfo, 'country');
            $province = array_get($userInfo, 'province');
            $city = array_get($userInfo, 'city');
            $unionId = array_get($userInfo, 'unionId');
            $sex = array_get($userInfo, 'sex');
            $gender = ($sex == 1) ? 'm' : (($sex == 2) ? 'f' : NULL);
        } elseif ($type == 'weibo') {
            $nickname = array_get($userInfo, 'name');
            $avatar = array_get($userInfo, 'avatar_large');
            $country = array_get($userInfo, 'country');
            $province = array_get($userInfo, 'province');
            $city = array_get($userInfo, 'city');
            $unionId = array_get($userInfo, 'unionId');
            $gender = array_get($userInfo, 'gender');
        }

        $user->nickname = $nickname;
        $user->avatar = $avatar;
        $user->country = $country;
        $user->province = $province;
        $user->city = $city;
        $user->unionId = $unionId;
        $user->gender = $gender;
        $user->data = json_encode($userInfo);

        if ($user->save()) {
            @$user->createStatus();
            return $user;
        } else {
            return NULL;
        }
    }
}