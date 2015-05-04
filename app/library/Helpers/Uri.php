<?php

namespace App\Helpers;

class Uri extends HelperBase
{
    public static function staticUrl($path)
    {
        if (substr($path, 0, 1) !== '/') {
            $moduleName = self::getShared('request')->getQuery('module');
            if (empty($moduleName))
                $moduleName = self::getShared('dispatcher')->getModuleName();
            $path = $moduleName . '/' . $path;
        }
        
        $config = self::get('config');
        $return = $config->application->staticUri . ltrim($path, '/');

        if ((substr($return, 0, 7) != 'http://') && substr($return, 0, 8) != 'https://') {
            $request = self::getShared('request');
            $httpHost = $request->getHttpHost();
            $return = 'http://' . $httpHost . '/' . ltrim($return, '/');
        }

        if (substr($path, -1) == '#') {
            $return = substr($return, 0, -1);
        } else {
            $config = self::getShared('config');
            if ($config->application->debug) {
                $version = TIMESTAMP;
            } else {
                $version = $config->application->staticVer;
            }
            $return .= (strpos($return, '?') === FALSE ? '?' : '&') . '_=' . $version;
        }

        return $return;
    }

    public static function staticPath($path)
    {
        if (substr($path, 0, 1) !== '/') {
            $moduleName = self::getShared('dispatcher')->getModuleName();
            $path = $moduleName . '/' . $path;
        }
        
        $config = self::get('config');

        return $config->application->staticPath . ltrim($path, '/');
    }

    public static function assetsJs($path)
    {
        $assets = self::get('assets');
        $assets->addJs(self::staticUrl($path), FALSE);

        return NULL;
    }

    public static function assetsCss($path)
    {
        $assets = self::get('assets');
        $assets->addCss(self::staticUrl($path), FALSE);

        return NULL;
    }
}