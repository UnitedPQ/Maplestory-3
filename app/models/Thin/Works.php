<?php

namespace App\Models\Thin;

class Works extends ModelBase
{
    protected $tableName = 'works';

    public $id;

    public $userId;

    public $nickname;

    public $a = 1;

    public $b = 1;

    public $c = 1;

    public $d = 1;

    public $e = 1;

    public $thickness = 10.00;

    public $ko;

    public $text1;

    public $text2;

    public $weibo;

    public $date;

    public function initialize()
    {
        parent::initialize();
        
        $this->belongsTo('userId', 'App\\Models\\User', 'id', array(
            'alias' => 'User'
        ));
    }

    public static function fetchLatest($userId)
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