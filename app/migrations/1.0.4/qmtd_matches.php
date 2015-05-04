<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class QmtdMatchesMigration_104 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'qmtd_matches',
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
                    'sourceId',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'id'
                    )
                ),
                new Column(
                    'destId',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'sourceId'
                    )
                ),
                new Column(
                    'sort',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 4,
                        'after' => 'destId'
                    )
                ),
                new Column(
                    'score',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 6,
                        'after' => 'sort'
                    )
                ),
                new Column(
                    'title',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 16,
                        'after' => 'score'
                    )
                ),
                new Column(
                    'description',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 255,
                        'after' => 'title'
                    )
                ),
                new Column(
                    'createTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'description'
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
                new Index('sourceId', array('sourceId')),
                new Index('destId', array('destId')),
                new Index('sourceId_destId', array('sourceId', 'destId'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '37',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            )
        )
        );
    }
}
