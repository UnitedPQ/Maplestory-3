<?php

namespace App\Models\Qmtd;

class Imei extends ModelBase
{
    protected $tableName = 'imei';

    public $id;

    public $userId;

    public $nickname;

    public $gender;

    public $imei;

    public $sn;

    public $machine;

    public $productionTime;

    public $data;

    public $constellationId;

    public $ipAddress;

    public $userAgent;

    public function initialize()
    {
        parent::initialize();

        $this->belongsTo('userId', 'App\\Models\\User', 'id', array(
            'alias' => 'User'
        ));
        
        $this->belongsTo('constellationId', 'App\\Models\\Qmtd\\Constellation', 'id', array(
            'alias' => 'constellation'
        ));
    }
}