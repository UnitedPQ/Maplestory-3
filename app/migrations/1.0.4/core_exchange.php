<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class CoreExchangeMigration_104 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'core_exchange',
            array(
            'columns' => array(
                new Column(
                    'id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 20,
                        'first' => true
                    )
                ),
                new Column(
                    'module',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 90,
                        'after' => 'id'
                    )
                ),
                new Column(
                    'activityId',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'module'
                    )
                ),
                new Column(
                    'userId',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'activityId'
                    )
                ),
                new Column(
                    'nickname',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 90,
                        'after' => 'userId'
                    )
                ),
                new Column(
                    'resultId',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 20,
                        'after' => 'nickname'
                    )
                ),
                new Column(
                    'prizeId',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'resultId'
                    )
                ),
                new Column(
                    'name',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 90,
                        'after' => 'prizeId'
                    )
                ),
                new Column(
                    'mobile',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 20,
                        'after' => 'name'
                    )
                ),
                new Column(
                    'idcard',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 36,
                        'after' => 'mobile'
                    )
                ),
                new Column(
                    'address',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'idcard'
                    )
                ),
                new Column(
                    'note',
                    array(
                        'type' => Column::TYPE_TEXT,
                        'size' => 1,
                        'after' => 'address'
                    )
                ),
                new Column(
                    'extra',
                    array(
                        'type' => Column::TYPE_TEXT,
                        'size' => 1,
                        'after' => 'note'
                    )
                ),
                new Column(
                    'ipAddress',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 40,
                        'after' => 'extra'
                    )
                ),
                new Column(
                    'userAgent',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'ipAddress'
                    )
                ),
                new Column(
                    'createTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'userAgent'
                    )
                ),
                new Column(
                    'updateTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'createTime'
                    )
                )
            ),
            'indexes' => array(
                new Index('PRIMARY', array('id')),
                new Index('module_activityId', array('module', 'activityId'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '2',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            )
        )
        );
    }
}
