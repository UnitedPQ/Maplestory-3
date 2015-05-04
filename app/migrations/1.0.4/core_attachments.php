<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class CoreAttachmentsMigration_104 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'core_attachments',
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
                        'size' => 32,
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
                        'after' => 'module'
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
                    'dir',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 64,
                        'after' => 'nickname'
                    )
                ),
                new Column(
                    'path',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'dir'
                    )
                ),
                new Column(
                    'thumbPath',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'path'
                    )
                ),
                new Column(
                    'name',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 128,
                        'after' => 'thumbPath'
                    )
                ),
                new Column(
                    'size',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 20,
                        'after' => 'name'
                    )
                ),
                new Column(
                    'type',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 90,
                        'after' => 'size'
                    )
                ),
                new Column(
                    'isImage',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 4,
                        'after' => 'type'
                    )
                ),
                new Column(
                    'width',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 11,
                        'after' => 'isImage'
                    )
                ),
                new Column(
                    'height',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 11,
                        'after' => 'width'
                    )
                ),
                new Column(
                    'createTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'height'
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
                new Index('PRIMARY', array('id'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '8',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            )
        )
        );
    }
}
