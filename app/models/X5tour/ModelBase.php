<?php

namespace App\Models\X5tour;

use App\Models\ModelBase as AppModelBase;

class ModelBase extends AppModelBase
{
    public function getSource()
    {
        if (empty($this->tableName)) {
            $this->tableName = strtolower(get_class($this));
        }

        return 'x5tour_' . $this->tableName;
    }
}