<?php

namespace App\Models\X5tour;

class Weibo extends ModelBase
{
    protected $tableName = 'weibo';

    public $id;

    public $cityId;

    public $userId;

    public $nickname;

    public $date;

    public $statusId;

    public $mId;

    public $text;

    public $status;

    public $response;

    public function initialize()
    {
        parent::initialize();
        
        $this->belongsTo('userId', 'App\\Models\\User', 'id', array(
            'alias' => 'User'
        ));
    }
}