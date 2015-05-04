<?php

namespace App\Models;

class DataBag extends ModelBase
{
    protected $tableName = 'data_bag';

    public $module = 'core';

    public $name;

    public $value;
}