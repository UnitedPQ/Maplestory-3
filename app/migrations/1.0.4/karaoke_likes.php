<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class KaraokeLikesMigration_104 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'karaoke_likes',
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
                    'sId',
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
                        'after' => 'sId'
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
                    'ipAddress',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 40,
                        'after' => 'nickname'
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
                new Index('sId_userId', array('sId', 'userId')),
                new Index('sId', array('sId'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '24',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            )
        )
        );
    }
}
