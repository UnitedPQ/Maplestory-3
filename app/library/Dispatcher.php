<?php

namespace App;

use Phalcon\Mvc\Dispatcher as PhDispatcher;
use Phalcon\Events\Manager as PhEventsManager;

class Dispatcher extends PhDispatcher
{
    public function __construct()
    {
        parent::__construct();

        $eventManager = new PhEventsManager();

        $eventManager->attach('dispatch', function($event, $dispatcher, $exception){
            /*if($event->getType() == 'beforeNotFoundAction') {
                $dispatcher->forward(array(
                    'controller' => 'error',
                    'action' => 'notfound',
                ));
                return FALSE;
            }

            if($event->getType() == 'beforeException') {
                switch($exception->getCode()) {
                    case PhDispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                    case PhDispatcher::EXCEPTION_ACTION_NOT_FOUND:
                        $dispatcher->forward(array(
                            'controller' => 'error',
                            'action' => 'notfound',
                        ));
                        return FALSE;
                }
            }*/
        });

        $this->setEventsManager($eventManager);
    }

    public function getParam($param, $filters = array())
    {
        $return = NULL;

        $params = $this->getParams();
        if (array_key_exists($param, $params)) {
            $return = parent::getParam($param, $filters);
        } else {
            $key = array_search($param, $params);
            $valueKey = $key + 1;

            if ($key !== FALSE && isset($params[$valueKey])) {
                $return = parent::getParam($valueKey, $filters);
            }
        }

        return $return;
    }

    public function getCurrentURI()
    {
        $di = $this->getDI();
        $request = $di->getShared('request');
        $httpHost = $request->getHttpHost();
        $uri = $request->getURI();

        return ($request->isSecureRequest() ? 'https://' : 'http://') . $httpHost . $uri;
    }
}