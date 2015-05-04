<?php

namespace App\Models;

class DrawResult extends ModelBase
{
    protected $tableName = 'draw_results';

    public $id;

    public $module;

    public $activityId = 0;

    public $userId;

    public $nickname;

    public $date;

    public $prizeId;

    public $isLuck = 0;

    public $isMobile = 0;

    public $isCoupon = 0;

    public $exchange = 0;

    public $exchangeTime;

    public $deadline = 0;

    public $couponId = 0;

    public function initialize()
    {
        parent::initialize();
        
        $this->belongsTo('userId', 'App\\Models\\User', 'id', array(
            'alias' => 'User'
        ));
        $this->belongsTo('prizeId', 'App\\Models\\Prize', 'id', array(
            'alias' => 'Prize'
        ));
    }
}