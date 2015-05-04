<?php

namespace App\Models;

class Exchange extends ModelBase
{
    protected $tableName = 'exchange';

    public $id;

    public $module;

    public $activityId = 0;

    public $userId;

    public $nickname;

    public $resultId;

    public $prizeId;

    public $name;

    public $mobile;

    public $idcard;

    public $address;

    public $note;

    public $extra;

    public $ipAddress;
    
    public $userAgent;

    public function initialize()
    {
        parent::initialize();
        
        $this->belongsTo('userId', 'App\\Models\\User', 'id', array(
            'alias' => 'User'
        ));
        $this->belongsTo('resultId', 'App\\Models\\DrawResult', 'id', array(
            'alias' => 'Result',
        ));
        $this->belongsTo('prizeId', 'App\\Models\\Prize', 'id', array(
            'alias' => 'Prize',
        ));
    }
}