<?php

namespace App\Models;

class Prize extends ModelBase
{
    protected $tableName = 'prize';

    public $id;

    public $module;

    public $activityId = 0;

    public $level = 0;

    public $name;

    public $unit;

    public $image;

    public $count = 0;

    public $total = 0;

    public $weight = 0;

    public $isLuck = 0;

    public $isMobile = 0;

    public $isCoupon = 0;

    public $extra = 0;

    public $sort = 0;

    public function raffle($num = 1)
    {
        $connection = $this->getWriteConnection();

        $tableName = $this->getSource();
        $sql = "UPDATE {$tableName} SET `count` = IF(`count` < `total`, `count` + 1, `count`) WHERE id = {$this->id}";
        $connection->execute($sql);
        return $connection->affectedRows() == 1;
    }

    public function extra($key = NULL, $default = NULL)
    {
        $extra = @json_decode($this->extra, TRUE);
        if (empty($key))
            return $extra;

        return array_get($extra, $key, $default);
    }
}