<?php

namespace App\Models;

class Task extends ModelBase
{
    protected $tableName = 'tasks';

    public $name;

    public $lockTime;

    public $expire = 0;
}