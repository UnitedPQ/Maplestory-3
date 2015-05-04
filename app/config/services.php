<?php

use Phalcon\DI\FactoryDefault;
use Phalcon\Flash\Direct as Flash;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Logger\Adapter\File as Logger;
use Phalcon\Session\Adapter\Database as Session;
use Phalcon\Session\Adapter\Files as FileSession;
use Phalcon\Cache\Frontend\Data as DataFrontend;
use Phalcon\Cache\Backend\File as FileCache;
use Phalcon\Cache\Backend\Apc as ApcCache;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Model\Manager as ModelManager;
use Phalcon\Mvc\Model\MetaData\Files as PhMetaData;
use Phalcon\Db\Adapter\Pdo\Mysql as PhMysql;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Security;
use Phalcon\Http\Response\Cookies;
use Phalcon\Crypt;

use App\Auth;
use App\UserAgent;
use App\Url;
use App\Json;
use App\Task;
use App\DataBag;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault;

/**
 * Register the global configuration as config
 */
$di->set('config', $config);

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($config) {
    $url = new Url();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Loading routes from the routes.php file
 */
$di->set('router', function() use ($config) {
    require APP_PATH . 'config/routes.php';
    return $router;
});

$di->set('logger', function () use ($config) {
    $logger = new Logger($config->application->logger->file);
    return $logger;
});

$di->set('cache', function () use ($config) {
    // Get the parameters
    $frontend = new DataFrontend(array(
        'lifetime' => $config->application->cache->lifeTime,
    ));

    if (function_exists('apc_store')) {
        $cache = new ApcCache($frontend);
    } else {
        $backendOptions  = array(
            'cacheDir' => $config->application->cache->dir,
        );

        $cache = new FileCache($frontend, $backendOptions);
    }

    return $cache;
});

/**
 * Register the flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Flash(array(
        'error' => 'alert alert-error',
        'success' => 'alert alert-success',
        'notice' => 'alert alert-info',
    ));
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flashSession', function () {
    return new FlashSession(array(
        'error' => 'alert alert-error',
        'success' => 'alert alert-success',
        'notice' => 'alert alert-info',
    ));
});

$di->set('db', function() use ($config) {
    $connection = new PhMysql(array(
        "host" => $config->database->host,
        "username" => $config->database->username,
        "password" => $config->database->password,
        "dbname" => $config->database->dbname,
        "charset" => $config->database->charset,
    ));

    if ($config->application->debug) {
        //开启日志记录
        $eventsManager = new EventsManager;
        $logger = new Logger($config->database->logpath . date('Y-m-d') . '-db.log');
        //监听数据库日志
        $eventsManager->attach('db', function($event, $connection) use ($logger) {
            if ($event->getType() == 'beforeQuery') {
                $logger->log($connection->getSQLStatement(), \Phalcon\Logger::INFO);
            }
        }); 
        $connection->setEventsManager($eventsManager);       
    }

    return $connection;
});

$di->set('modelsManager', function() {
    return new ModelManager;
});

if ( ! $config->application->debug) {
    $di->set('modelsMetadata', function() use ($config) {
        $metaData = new PhMetaData(array(
            'metaDataDir' => $config->database->logpath,
            'lifetime' => 86400,
            'prefix' => 'my-prefix',
        ));
        
        return $metaData;
    });
}

//if ($config->application->debug) {
    $di->set('session', function () {
        $session = new FileSession();
        $session->start();
        return $session;
    });
/*} else {
    $di->set('session', function () use ($di) {
        $connection = $di->getShared('db');
        $session = new Session(array(
            'db' => $connection,
            'table' => 'core_sessions',
            'column_session_id' => 'id',
            'column_created_at' => 'createTime',
            'column_modified_at' => 'updateTime',
        ));
        $session->start();
        return $session;
    });
}*/

$di->set('security', function() {
    $security = new Security;

    $security->setWorkFactor(16);

    return $security;
}, TRUE);

$di->set('cookies', function() use ($config) {
    $cookies = new Cookies;
    $cookies->useEncryption($config->application->cookies->encryption);
    return $cookies;
});

$di->set('crypt', function() use ($config) {
    $crypt = new Crypt;
    $crypt->setKey($config->application->cookies->cryptKey);
    return $crypt;
});

$di->set('auth', function () {
    return new Auth;
});

$di->set('userAgent', function () {
    return new UserAgent;
});

$di->set('json', function () {
    return new Json;
});

$di->set('task', function () {
    return new Task;
});

$di->set('dataBag', function () {
    return new DataBag;
});