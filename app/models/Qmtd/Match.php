<?php

namespace App\Models\Qmtd;

class Match extends ModelBase
{
    protected $tableName = 'matches';

    public $id;

    public $sourceId;

    public $destId;

    public $sort;

    public $score;

    public $title;

    public function initialize()
    {
        parent::initialize();
        
        $this->belongsTo('sourceId', 'App\\Models\\Qmtd\\Constellation', 'id', array(
            'alias' => 'source'
        ));

        $this->belongsTo('destId', 'App\\Models\\Qmtd\\Constellation', 'id', array(
            'alias' => 'dest'
        ));
    }

    public function getSortLabel()
    {
        $label = '未知';

        switch ($this->sort) {
            case 1:
                $label = '第一名';
                break;

            case 2:
                $label = '第二名';
                break;

            case 3:
                $label = '第三名';
                break;
            
            default:
                break;
        }

        return $label;
    }
}