<?php

namespace App;

use Phalcon\DI;
use Phalcon\Mvc\User\Component;

use App\Models\DataBag as DataModel;

class DataBag extends Component
{
    public function has($name, $module = NULL)
    {
        if (is_null($module))
            $module = $this->getModuleName();

        $data = $this->getRecord($name, $module);
        return $data && $data->name;
    }

    public function set($name, $value = NULL, $module = NULL)
    {
        if (is_null($module))
            $module = $this->getModuleName();

        $data = $this->getRecord($name, $module);
        if (empty($data) || empty($data->name)) {
            $data = new DataModel;
            $data->module = $module;
            $data->name = $name;
        }

        $data->value = json_encode($value);

        return $data->save();
    }

    public function get($name, $default = NULL, $module = NULL)
    {
        if (is_null($module))
            $module = $this->getModuleName();

        $data = $this->getRecord($name, $module);
        if (empty($data) || empty($data->name)) {
            return $default;
        } else {
            return json_decode($data->value, TRUE);
        }
    }

    private function getRecord($name, $module = NULL)
    {
        if (is_null($module))
            $module = $this->getModuleName();

        return DataModel::findFirst(array(
            'conditions' => 'module = :module: AND name = :name:',
            'bind' => array(
                'module' => $module,
                'name' => $name,
            ),
        ));
    }

    private function getModuleName()
    {
        $moduleName = $this->dispatcher->getModuleName();
        if (empty($moduleName)) {
            $moduleName = 'core';
        }

        return $moduleName;
    }
}