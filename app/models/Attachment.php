<?php

namespace App\Models;

class Attachment extends ModelBase
{
    protected $tableName = 'attachments';

    public $module = 'core';

    public $userId;

    public $nickname;

    public $dir;

    public $path;

    public $thumbPath;

    public $name;

    public $size = 0;

    public $type;

    public $isImage = 0;

    public $width;

    public $height;
}