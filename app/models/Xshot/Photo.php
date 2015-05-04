<?php

namespace App\Models\Xshot;

class Photo extends ModelBase
{
    protected $tableName = 'photo';

    public $id;

    public $filename;

    public $author;

    public $make;

    public $model;

    public $exposureTime;

    public $iso;

    public $fNumber;

    public $exposureBiasValue;

    public $exif;

    public $sort = 0;
}