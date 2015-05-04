<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class CoreDrawResultsMigration_104 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'core_draw_results',
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
                        'size' => 40,
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
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'activityId'
                    )
                ),
                new Column(
                    'nickname',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 90,
                        'after' => 'userId'
                    )
                ),
                new Column(
                    'date',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 8,
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
                        'after' => 'date'
                    )
                ),
                new Column(
                    'isLuck',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 4,
                        'after' => 'prizeId'
                    )
                ),
                new Column(
                    'isMobile',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 4,
                        'after' => 'isLuck'
                    )
                ),
                new Column(
                    'isCoupon',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 4,
                        'after' => 'isMobile'
                    )
                ),
                new Column(
                    'exchange',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 4,
                        'after' => 'isCoupon'
                    )
                ),
                new Column(
                    'exchangeTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 10,
                        'after' => 'exchange'
                    )
                ),
                new Column(
                    'deadline',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'exchangeTime'
                    )
                ),
                new Column(
                    'couponId',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 20,
                        'after' => 'deadline'
                    )
                ),
                new Column(
                    'createTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'couponId'
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
                new Index('userId', array('userId')),
                new Index('module_activityId', array('module', 'activityId')),
                new Index('module_activityId_userId', array('module', 'activityId', 'userId')),
                new Index('deadline', array('deadline'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '199',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            )
        )
        );
    }
}
