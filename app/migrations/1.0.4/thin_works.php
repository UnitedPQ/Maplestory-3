<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class ThinWorksMigration_104 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'thin_works',
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
                    'userId',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'id'
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
                    'a',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 6,
                        'after' => 'nickname'
                    )
                ),
                new Column(
                    'b',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 6,
                        'after' => 'a'
                    )
                ),
                new Column(
                    'c',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 6,
                        'after' => 'b'
                    )
                ),
                new Column(
                    'd',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 6,
                        'after' => 'c'
                    )
                ),
                new Column(
                    'e',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 6,
                        'after' => 'd'
                    )
                ),
                new Column(
                    'thickness',
                    array(
                        'type' => Column::TYPE_DOUBLE,
                        'size' => 5,
                        'scale' => 2,
                        'after' => 'e'
                    )
                ),
                new Column(
                    'ko',
                    array(
                        'type' => Column::TYPE_DOUBLE,
                        'size' => 5,
                        'scale' => 2,
                        'after' => 'thickness'
                    )
                ),
                new Column(
                    'text1',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'ko'
                    )
                ),
                new Column(
                    'text2',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'text1'
                    )
                ),
                new Column(
                    'weibo',
                    array(
                        'type' => Column::TYPE_TEXT,
                        'size' => 1,
                        'after' => 'text2'
                    )
                ),
                new Column(
                    'date',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 10,
                        'after' => 'weibo'
                    )
                ),
                new Column(
                    'createTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'date'
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
                new Index('thickness', array('thickness')),
                new Index('userId_createTime', array('userId', 'createTime')),
                new Index('userId_date', array('userId', 'date'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '18',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            )
        )
        );
    }
}
