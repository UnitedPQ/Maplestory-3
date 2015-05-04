<?php

namespace App\Models;

class Share extends ModelBase
{
    protected $tableName = 'share';

    public $id;

    public $userId;

    public $nickname;

    public $module;

    public $date;

    public $type;

    public $data;

    public $userAgent;

    public $ipAddress;
}