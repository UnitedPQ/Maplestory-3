<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class CoreShareMigration_104 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'core_share',
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
                    'module',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 32,
                        'after' => 'nickname'
                    )
                ),
                new Column(
                    'date',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 8,
                        'after' => 'module'
                    )
                ),
                new Column(
                    'type',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 16,
                        'after' => 'date'
                    )
                ),
                new Column(
                    'data',
                    array(
                        'type' => Column::TYPE_TEXT,
                        'size' => 1,
                        'after' => 'type'
                    )
                ),
                new Column(
                    'createTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'data'
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
                new Index('userId_date', array('userId', 'date')),
                new Index('userId_module_date', array('userId', 'module', 'date'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '9',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            )
        )
        );
    }
}
