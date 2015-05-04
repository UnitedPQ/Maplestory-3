<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class X5tourWeiboMigration_104 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'x5tour_weibo',
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
                    'cityId',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'id'
                    )
                ),
                new Column(
                    'userId',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'cityId'
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
                    'date',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 10,
                        'after' => 'nickname'
                    )
                ),
                new Column(
                    'statusId',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 90,
                        'after' => 'date'
                    )
                ),
                new Column(
                    'mId',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 90,
                        'after' => 'statusId'
                    )
                ),
                new Column(
                    'text',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'mId'
                    )
                ),
                new Column(
                    'status',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'text'
                    )
                ),
                new Column(
                    'response',
                    array(
                        'type' => Column::TYPE_TEXT,
                        'size' => 1,
                        'after' => 'status'
                    )
                ),
                new Column(
                    'createTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'response'
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
                new Index('cityId', array('cityId')),
                new Index('createTime', array('createTime')),
                new Index('cityId_createTime', array('cityId', 'createTime')),
                new Index('userId_date', array('userId', 'date'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '27',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            )
        )
        );
    }
}
