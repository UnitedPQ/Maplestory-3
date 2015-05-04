<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class CorePrizeMigration_104 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'core_prize',
            array(
            'columns' => array(
                new Column(
                    'id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 11,
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
                    'level',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 6,
                        'after' => 'activityId'
                    )
                ),
                new Column(
                    'name',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 90,
                        'after' => 'level'
                    )
                ),
                new Column(
                    'unit',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 4,
                        'after' => 'name'
                    )
                ),
                new Column(
                    'image',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'unit'
                    )
                ),
                new Column(
                    'count',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'image'
                    )
                ),
                new Column(
                    'total',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'count'
                    )
                ),
                new Column(
                    'weight',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'total'
                    )
                ),
                new Column(
                    'isLuck',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 4,
                        'after' => 'weight'
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
                    'extra',
                    array(
                        'type' => Column::TYPE_TEXT,
                        'size' => 1,
                        'after' => 'isCoupon'
                    )
                ),
                new Column(
                    'sort',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'extra'
                    )
                ),
                new Column(
                    'createTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'sort'
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
                'AUTO_INCREMENT' => '29',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            )
        )
        );
    }
}
