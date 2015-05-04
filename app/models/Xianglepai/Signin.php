<?php

namespace App\Models\Xianglepai;

class Signin extends ModelBase
{
    protected $tableName = 'signin';

    public $id;

    public $userId;

    public $nickname;

    public $date;
}