<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class X5tourCityMigration_104 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'x5tour_city',
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
                    'name',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 20,
                        'after' => 'id'
                    )
                ),
                new Column(
                    'label',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'name'
                    )
                ),
                new Column(
                    'status',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 6,
                        'after' => 'label'
                    )
                ),
                new Column(
                    'startTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 10,
                        'after' => 'status'
                    )
                ),
                new Column(
                    'endTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 10,
                        'after' => 'startTime'
                    )
                ),
                new Column(
                    'eventTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 10,
                        'after' => 'endTime'
                    )
                ),
                new Column(
                    'sort',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 6,
                        'after' => 'eventTime'
                    )
                ),
                new Column(
                    'blankMsg',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'sort'
                    )
                ),
                new Column(
                    'weibo',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'blankMsg'
                    )
                ),
                new Column(
                    'regUrl',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'weibo'
                    )
                ),
                new Column(
                    'createTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'regUrl'
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
                new Index('startTime', array('startTime')),
                new Index('endTime', array('endTime'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '7',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            )
        )
        );
    }
}
