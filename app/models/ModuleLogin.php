<?php

namespace App\Models;

class ModuleLogin extends ModelBase
{
    protected $tableName = 'module_login';

    public $id;

    public $userId;

    public $nickname;

    public $module;
}