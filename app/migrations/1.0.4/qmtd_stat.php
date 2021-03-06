<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class QmtdStatMigration_104 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'qmtd_stat',
            array(
            'columns' => array(
                new Column(
                    'userId',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 11,
                        'first' => true
                    )
                ),
                new Column(
                    'drawTotal',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'userId'
                    )
                ),
                new Column(
                    'drawLeft',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'drawTotal'
                    )
                ),
                new Column(
                    'gender',
                    array(
                        'type' => Column::TYPE_CHAR,
                        'size' => 1,
                        'after' => 'drawLeft'
                    )
                ),
                new Column(
                    'imeiId',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 11,
                        'after' => 'gender'
                    )
                ),
                new Column(
                    'imei',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 20,
                        'after' => 'imeiId'
                    )
                ),
                new Column(
                    'constellationId',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 11,
                        'after' => 'imei'
                    )
                ),
                new Column(
                    'createTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'constellationId'
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
                new Index('PRIMARY', array('userId'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            )
        )
        );
    }
}
