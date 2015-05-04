<?php

namespace App\Models\Xianglepai;

use App\Models\ModelBase as AppModelBase;

class ModelBase extends AppModelBase
{
    public function getSource()
    {
        if (empty($this->tableName)) {
            $this->tableName = strtolower(get_class($this));
        }

        return 'xianglepai_' . $this->tableName;
    }
}