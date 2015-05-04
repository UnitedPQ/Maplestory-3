<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class CoreUsersMigration_104 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'core_users',
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
                    'openId',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 90,
                        'after' => 'id'
                    )
                ),
                new Column(
                    'nickname',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 90,
                        'after' => 'openId'
                    )
                ),
                new Column(
                    'type',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 12,
                        'after' => 'nickname'
                    )
                ),
                new Column(
                    'avatar',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'type'
                    )
                ),
                new Column(
                    'gender',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 1,
                        'after' => 'avatar'
                    )
                ),
                new Column(
                    'country',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 32,
                        'after' => 'gender'
                    )
                ),
                new Column(
                    'province',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 32,
                        'after' => 'country'
                    )
                ),
                new Column(
                    'city',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 32,
                        'after' => 'province'
                    )
                ),
                new Column(
                    'accessToken',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'city'
                    )
                ),
                new Column(
                    'unionId',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 90,
                        'after' => 'accessToken'
                    )
                ),
                new Column(
                    'data',
                    array(
                        'type' => Column::TYPE_TEXT,
                        'size' => 1,
                        'after' => 'unionId'
                    )
                ),
                new Column(
                    'weiboId',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 90,
                        'after' => 'data'
                    )
                ),
                new Column(
                    'createTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'weiboId'
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
                new Index('openId', array('openId')),
                new Index('nickname', array('nickname'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '14',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            )
        )
        );
    }
}
