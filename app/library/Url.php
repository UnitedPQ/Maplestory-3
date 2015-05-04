<?php

namespace App;

use Phalcon\Mvc\Url as PhUrl;
use Phalcon\DI;

class Url extends PhUrl
{
    function get($uri = NULL, $args = NULL, $local = NULL)
    {
        $di = DI::getDefault();

        if (!is_array($uri) && (substr($uri, 0, 1) == '/')) {
            $uri = substr($uri, 1);
        }

        if (empty($uri) || is_array($uri)) {
            $return = parent::get($uri, $args, $local);
        } else {
            $format = '/';

            if (strrpos($uri, '.') !== FALSE) {
                $format = substr($uri, strrpos($uri, '.'));
                $uri = substr($uri, 0, strrpos($uri, '.'));

                $format = $format == '.html' ? '/' : $format;
            }

            $specialArgs = array('id', 'page');
            foreach ($specialArgs as $arg) {
                if (isset($args[$arg]) && $args[$arg]) {
                    $uri = rtrim($uri, '/') . '/' . $arg . '/' . $args[$arg];
                }
                unset($args[$arg]);
            }

            $uri = rtrim($uri, '/');
            $return = parent::get($uri . $format, $args, $local);
        }

        if ((substr($return, 0, 7) != 'http://') && substr($return, 0, 8) != 'https://') {
            $request = $di->getShared('request');
            $httpHost = $request->getHttpHost();
            $return = 'http://' . $httpHost . '/' . ltrim($return, '/');
        }

        return $return;
    }
}