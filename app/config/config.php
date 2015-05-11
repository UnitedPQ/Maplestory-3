<?php

$develop = empty($_SERVER['vivo']);

return new \Phalcon\Config(array(
    'appName' => 'baseApp',
    'database' => array(
        'adapter' => 'Mysql',
        'host' => $develop ? '127.0.0.1' : 'mysql.db.vivo.com.cn',
        'username' => 'root',
        'password' => '123456',
        'dbname' => 'maplestory',
        'charset' => 'utf8',
        'logpath' => APP_PATH . 'cache/logs/',
    ),
    'application' => array(
        'debug' => $develop,
        'timezone' => 'Asia/Shanghai',

        'libraryDir' => APP_PATH . 'library/',
        'modelsDir' => APP_PATH . 'models/',
        'modulesDir' => APP_PATH . 'modules/',

        'baseUri' => '/',
        'staticUri' => '/static/',
        'staticPath' => WEB_PATH . 'static/',
        'staticVer' => 'YiweIH',

        'logger' => array(
            'adapter' => 'File',
            'file' => APP_PATH . 'cache/logs/website.log',
            'format' => '[%date%][%type%] %message%',
        ),

        'volt' => array(
            'path' => APP_PATH . 'cache/volt/',
            'extension' => '.php',
            'separator' => '%%',
            'stat' => TRUE,
        ),

        'cache' => array(
            'dir' => APP_PATH . 'cache/',
            'lifeTime' => 86400,
        ),

        'cookies' => array(
            'encryption' => FALSE,
            'cryptKey' => '~8KHvG+@ejnZkp#xyv*@SMxR',
            'sessionKey' => 'VyD2l]cUwL_lK#5yd!}dKUr#',
        ),

        /*'upload' => array(
            'basePath' => $develop ? WEB_PATH . 'uploaded/' : '/files/activity/attachments/',
            'baseUri' => $develop ? '/uploaded/' : 'http://files.vivo.com.cn/activity/attachments/',
            'dirRule' => 'Y/m-d/',
            'sizeLimit' => 1024 * 1024 * 5,
        ),*/
        'upload' => array(
            'basePath' => WEB_PATH . 'uploaded/',
            'baseUri' => '/uploaded/',
            'dirRule' => 'Y/m-d/',
            'sizeLimit' => 1024 * 1024 * 5,
        ),
    ),
    'weibo' => array(
        'appKey' => $develop ? '1121303653' : '3752441440',
        'appSecret' => $develop ? 'a159ae705d17e50ff5c5014f634722c0' : '68085ed069cb907f483de497a29ae7c8',
        'clientId' => '1809745371',
    ),
    'weixin' => array(
        'appId' => 'wx1860a110b3f0e559',
        'appKey' => '888441698bf3b8e2329c0fd08dd946b3',
        'callback' => 'http://wx.vivo.com.cn/c62.php',
    ),
));
