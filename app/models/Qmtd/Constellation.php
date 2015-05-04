<?php

namespace App\Models\Qmtd;

class Constellation extends ModelBase
{
    protected $tableName = 'constellation';

    public $id;

    public $name;

    public $label;

    public $start;

    public $end;

    public $tips;
}