<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class QmtdImeiMigration_104 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'qmtd_imei',
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
                    'gender',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 10,
                        'after' => 'nickname'
                    )
                ),
                new Column(
                    'imei',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 20,
                        'after' => 'gender'
                    )
                ),
                new Column(
                    'sn',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 20,
                        'after' => 'imei'
                    )
                ),
                new Column(
                    'machine',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 20,
                        'after' => 'sn'
                    )
                ),
                new Column(
                    'productionTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'machine'
                    )
                ),
                new Column(
                    'data',
                    array(
                        'type' => Column::TYPE_TEXT,
                        'size' => 1,
                        'after' => 'productionTime'
                    )
                ),
                new Column(
                    'constellationId',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'data'
                    )
                ),
                new Column(
                    'date',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 10,
                        'after' => 'constellationId'
                    )
                ),
                new Column(
                    'ipAddress',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 40,
                        'after' => 'date'
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
                new Index('userId', array('userId')),
                new Index('imei', array('imei')),
                new Index('gender_constellationId', array('gender', 'constellationId')),
                new Index('userId_imei', array('userId', 'imei')),
                new Index('userId_date', array('userId', 'date'))
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
