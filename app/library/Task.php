<?php

namespace App;

use Phalcon\DI;
use Phalcon\Mvc\User\Component;

use App\Models\Task as TaskModel;

class Task extends Component
{
    public function isLocked($name)
    {
        $task = TaskModel::findFirst(array(
            'conditions' => 'name = :name:',
            'bind' => array(
                'name' => $name,
            ),
        ));

        if (empty($task) || empty($task->name))
            return FALSE;

        if (($task->expire > 0) && ($task->lockTime + $task->expire < TIMESTAMP)) {
            $task->delete();
            return FALSE;
        }

        return TRUE;
    }

    public function lock($name, $expire = 0)
    {
        if ($this->isLocked($name)) {
            return TRUE;
        }

        $task = new TaskModel;
        $task->name = $name;
        $task->lockTime = TIMESTAMP;
        $task->expire = $expire;
        return $task->save();
    }

    public function unlock($name)
    {
        return TaskModel::find(array(
            'conditions' => 'name = :name:',
            'bind' => array(
                'name' => $name,
            ),
        ))->delete();
    }
}