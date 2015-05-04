<?php

namespace App;

use Phalcon\DI;
use Phalcon\Mvc\User\Component;

class Json extends Component
{
    private $_json = array('errcode' => -9999, 'errmsg' => '未知错误');

    public function set($var, $value = NULL)
    {
        if (is_array($var))
            $this->setVars($var);
        else
            $this->setVar($var, $value);
    }

    public function setVars(array $arr)
    {
        $this->view->setVars($arr);
        $this->_json = array_merge($this->_json, $arr);
    }

    public function setVar($var, $value)
    {
        $this->view->setVar($var, $value);
        $this->_json[$var] = $value;
    }

    public function message($code, $message = NULL, $type = NULL)
    {
        $this->setVars(array(
            'errcode' => $code,
            'errmsg' => $message,
        ));

        $flashSession = $this->getDI()->get('flashSession');
        switch ($type) {
            case 'success':
                $flashSession->success($message);
                break;

            case 'warning':
                $flashSession->warning($message);
                break;

            case 'error':
                $flashSession->error($message);
                break;

            case 'info':
            case 'notice':
                $flashSession->notice($message);
                break;
        }
    }

    public function success($message = NULL, $flash = FALSE)
    {
        $this->message(0, $message, $flash ? 'success' : NULL);
    }

    public function warning($message = NULL, $flash = FALSE)
    {
        $this->message(-1, $message, $flash ? 'warning' : NULL);
    }

    public function error($message = NULL, $flash = FALSE)
    {
        $this->message(-2, $message, $flash ? 'error' : NULL);
    }

    public function notice($message = NULL, $flash = FALSE)
    {
        $this->message(0, $message, $flash ? 'notice' : NULL);
    }

    public function toString()
    {
        return json_encode($this->_json);
    }
}