<?php

namespace App\Models;

class ViewLog extends ModelBase
{
    protected $tableName = 'view_logs';

    public $userId;

    public $nickname;

    public $module;

    public $page;

    public $url;

    public $ipAddress;

    public $userAgent;
}