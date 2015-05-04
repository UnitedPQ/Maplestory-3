<?php

namespace App\Models\Newyear;

class Msg extends ModelBase
{
    protected $tableName = 'msg';

    public $userId;

    public $nickname;

    public $name;

    public $lyricNo;

    public static function findLatest($userId)
    {
        return self::findFirst(array(
            'conditions' => 'userId = :userId:',
            'bind' => array(
                'userId' => $userId,
            ),
            'order' => 'createTime DESC',
        ));
    }
}