<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class KaraokeStatusesMigration_104 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'karaoke_statuses',
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
                    'statusId',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 20,
                        'after' => 'id'
                    )
                ),
                new Column(
                    'mId',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 20,
                        'after' => 'statusId'
                    )
                ),
                new Column(
                    'openId',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 90,
                        'after' => 'mId'
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
                    'avatar',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'nickname'
                    )
                ),
                new Column(
                    'urlKey',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 32,
                        'after' => 'avatar'
                    )
                ),
                new Column(
                    'videoUrl',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'urlKey'
                    )
                ),
                new Column(
                    'videoType',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 10,
                        'after' => 'videoUrl'
                    )
                ),
                new Column(
                    'videoImg',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'videoType'
                    )
                ),
                new Column(
                    'videoId',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'videoImg'
                    )
                ),
                new Column(
                    'player',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'videoId'
                    )
                ),
                new Column(
                    'flashVars',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'player'
                    )
                ),
                new Column(
                    'mp4Url',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'flashVars'
                    )
                ),
                new Column(
                    'content',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'mp4Url'
                    )
                ),
                new Column(
                    'statusData',
                    array(
                        'type' => Column::TYPE_TEXT,
                        'size' => 1,
                        'after' => 'content'
                    )
                ),
                new Column(
                    'statusTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'statusData'
                    )
                ),
                new Column(
                    'likeTotal',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'statusTime'
                    )
                ),
                new Column(
                    'syncTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'likeTotal'
                    )
                ),
                new Column(
                    'createTime',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'syncTime'
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
                new Index('statusId', array('statusId')),
                new Index('videoId', array('videoId')),
                new Index('videoType_videoId', array('videoType', 'videoId')),
                new Index('urlKey', array('urlKey'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '11',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            )
        )
        );
    }
}
