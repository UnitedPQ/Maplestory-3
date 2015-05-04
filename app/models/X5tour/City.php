<?php

namespace App\Models\X5tour;

class City extends ModelBase
{
    protected $tableName = 'city';

    public $id;

    public $name;

    public $label;

    public $status = 0;

    public $startTime;

    public $endTime;

    public $eventTime;

    public $sort = 0;

    public $blankMsg;

    public $weibo;

    public $regUrl;

    public static function updateStatus($timestamp)
    {
        $model = new City;
        
        $connection = $model->getWriteConnection();

        $tableName = $model->getSource();
        $sql = "UPDATE {$tableName} SET `status` = 1 WHERE `startTime` <= {$timestamp} AND `endTime` >= {$timestamp}; UPDATE {$tableName} SET `status` = 2 WHERE `endTime` < {$timestamp} AND `status` < 2;";
        $connection->execute($sql);
        
        return $connection->affectedRows();
    }
}