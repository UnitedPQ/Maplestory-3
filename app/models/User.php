<?php

namespace App\Models;

class User extends ModelBase
{
    protected $tableName = 'users';

    public $id;

    public $openId;

    public $nickname;

    public $type;

    public $avatar;

    public $gender;

    public $country;

    public $province;

    public $city;

    public $accessToken;

    public $unionId;

    public $data;

    public $weiboId;

    public function initialize()
    {
        parent::initialize();

        $this->hasOne('id', 'App\\Models\\UserStatus', 'userId', array(
            'alias' => 'Status'
        ));

        $this->hasOne('weiboId', 'App\\Models\\User', 'id', array(
            'alias' => 'WeiboUser'
        ));
    }

    public static function findByOpenId($openId)
    {
        return self::findFirst(array(
            'conditions' => 'openId = :openId:',
            'bind' => array(
                'openId' => $openId,
            ),
        ));
    }

    public function createStatus()
    {
        $status = UserStatus::findFirst(array(
            'conditions' => 'userId = :userId:',
            'bind' => array(
                'userId' => $this->id,
            ),
        ));

        if (empty($status) || empty($status->userId)) {
            $status = new UserStatus;
            $status->userId = $this->id;
            $status->save();
        }
    }

    public function getOppositeSex()
    {
        return $this->gender == 'm' ? 'f' : 'm';
    }
}