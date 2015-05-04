<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class XshotPhotoMigration_104 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'xshot_photo',
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
                    'filename',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 64,
                        'after' => 'id'
                    )
                ),
                new Column(
                    'author',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 64,
                        'after' => 'filename'
                    )
                ),
                new Column(
                    'make',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 128,
                        'after' => 'author'
                    )
                ),
                new Column(
                    'model',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 128,
                        'after' => 'make'
                    )
                ),
                new Column(
                    'exposureTime',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 16,
                        'after' => 'model'
                    )
                ),
                new Column(
                    'iso',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 11,
                        'after' => 'exposureTime'
                    )
                ),
                new Column(
                    'fNumber',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 16,
                        'after' => 'iso'
                    )
                ),
                new Column(
                    'exposureBiasValue',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 11,
                        'after' => 'fNumber'
                    )
                ),
                new Column(
                    'exif',
                    array(
                        'type' => Column::TYPE_TEXT,
                        'size' => 1,
                        'after' => 'exposureBiasValue'
                    )
                ),
                new Column(
                    'sort',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'exif'
                    )
                ),
                new Column(
                    'createTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'sort'
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
                new Index('filename', array('filename'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '42',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            )
        )
        );
    }
}
