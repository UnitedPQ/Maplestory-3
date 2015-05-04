<?php

namespace App\Models\Thin;

class Stat extends ModelBase
{
    protected $tableName = 'stat';

    public $userId;

    public $drawTotal = 0;

    public $drawLeft = 0;

    public $weiboDate;

    public $shareDate;

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

    public function drawReset()
    {
        $connection = $this->getWriteConnection();

        $tableName = $this->getSource();
        $sql = "UPDATE {$tableName} SET `drawLeft` = 0, `weiboDate` = NULL, `shareDate` = NULL WHERE userId = {$this->userId}";
        $connection->execute($sql);
        
        return $connection->affectedRows() == 1;
    }

    public function drawAdd($num = 3, $flag = NULL)
    {
        $num = intval($num);

        $connection = $this->getWriteConnection();
        $flagSQL = '';
        if ($flag == 'weibo') {
            $flagSQL = ', `weiboDate` = "' . DATE_STR . '"';
        } elseif ($flag == 'share') {
            $flagSQL = ', `shareDate` = "' . DATE_STR . '"';
        }

        $tableName = $this->getSource();
        $sql = "UPDATE {$tableName} SET `drawTotal` = `drawTotal` + {$num}, `drawLeft` = `drawLeft` + {$num}{$flagSQL} WHERE userId = {$this->userId}";
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