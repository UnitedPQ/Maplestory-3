<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class QmtdConstellationMigration_104 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'qmtd_constellation',
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
                        'size' => 16,
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
                    'start',
                    array(
                        'type' => Column::TYPE_CHAR,
                        'notNull' => true,
                        'size' => 4,
                        'after' => 'label'
                    )
                ),
                new Column(
                    'end',
                    array(
                        'type' => Column::TYPE_CHAR,
                        'notNull' => true,
                        'size' => 4,
                        'after' => 'start'
                    )
                ),
                new Column(
                    'tips',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'end'
                    )
                ),
                new Column(
                    'createTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'tips'
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
                new Index('start_end', array('start', 'end')),
                new Index('start', array('start')),
                new Index('end', array('end'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '13',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            )
        )
        );
    }
}
