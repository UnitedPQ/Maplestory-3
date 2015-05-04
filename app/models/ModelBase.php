<?php

namespace App\Models;

use Phalcon\Mvc\Model;

class ModelBase extends Model
{
    protected $_isNew = TRUE;

    public $createTime;

    public $updateTime;

    protected $tableName = NULL;

    public function getSource()
    {
        if (empty($this->tableName)) {
            $this->tableName = strtolower(get_class($this));
        }

        return 'core_' . $this->tableName;
    }

    public function initialize()
    {
        $this->useDynamicUpdate(TRUE);
    }

    public function beforeValidationOnCreate()
    {
        $this->createTime = TIMESTAMP;
        $this->updateTime = TIMESTAMP;
    }

    public function beforeValidationOnUpdate()
    {
        $this->updateTime = TIMESTAMP;
    }

    public function afterFetch()
    {
        $this->_isNew = FALSE;
    }

    public function isNewRecord()
    {
        return $this->_isNew;
    }

    public static function findById($id)
    {
        return self::findFirst(array(
            'conditions' => 'id = :id:',
            'bind' => array(
                'id' => $id,
            ),
        ));
    }
}