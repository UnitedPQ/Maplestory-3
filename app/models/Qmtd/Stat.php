<?php

namespace App\Models\Qmtd;

class Stat extends ModelBase
{
    protected $tableName = 'stat';

    public $userId;

    public $drawTotal = 0;

    public $drawLeft = 0;

    public $gender;

    public $imeiId;

    public $imei;

    public $constellationId;

    public static function fetch($userId)
    {
        $stat = self::findFirst(array(
            'conditions' => 'userId = :userId:',
            'bind' => array(
                'userId' => $userId,
            ),
        ));

        if (empty($stat) || empty($stat->userId)) {
            $stat = new Stat;
            $stat->userId = $userId;
            $stat->save();
        }

        return $stat;
    }

    public function initialize()
    {
        parent::initialize();

        $this->belongsTo('userId', 'App\\Models\\User', 'id', array(
            'alias' => 'User'
        ));
    }

    public function drawReset($num = 1)
    {
        $num = intval($num);

        $connection = $this->getWriteConnection();

        $tableName = $this->getSource();
        $sql = "UPDATE {$tableName} SET `drawTotal` = `drawTotal` + {$num}, `drawLeft` = {$num} WHERE userId = {$this->userId}";
        $connection->execute($sql);
        
        return $connection->affectedRows() == 1;
    }

    public function drawAdd($num = 3)
    {
        $num = intval($num);

        $connection = $this->getWriteConnection();

        $tableName = $this->getSource();
        $sql = "UPDATE {$tableName} SET `drawTotal` = `drawTotal` + {$num}, `drawLeft` = `drawLeft` + {$num} WHERE userId = {$this->userId}";
        $connection->execute($sql);
        
        return $connection->affectedRows() == 1;
    }

    public function drawUse($num = 1)
    {
        $num = intval($num);

        $connection = $this->getWriteConnection();

        $tableName = $this->getSource();
        $sql = "UPDATE {$tableName} SET `drawLeft` = IF(`drawLeft` > 0, `drawLeft` - {$num}, `drawLeft`) WHERE userId = {$this->userId}";
        $connection->execute($sql);
        
        return $connection->affectedRows() == 1;
    }
}