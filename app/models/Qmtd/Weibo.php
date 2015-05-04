<?php

namespace App\Models\Qmtd;

class Weibo extends ModelBase
{
    protected $tableName = 'weibo';

    public $id;

    public $userId;

    public $nickname;

    public $date;

    public $text;

    public $response;

    public function initialize()
    {
        parent::initialize();
        
        $this->belongsTo('userId', 'App\\Models\\User', 'id', array(
            'alias' => 'User'
        ));
    }
}