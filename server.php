<?php

class HttpServer
{
    public static $instance;
    public $http;
    public static $get;
    public static $post;
    public static $header;
    public static $server;
    private $application;
    private $config;

    public function __construct() {
        $http = new swoole_http_server("127.0.0.1", 3000);
        $http->set(
            array(
                'worker_num' => 16,
                'daemonize' => true,
                'max_request' => 10000,
                'dispatch_mode' => 1
            )
        );
        $http->on('WorkerStart', array($this , 'onWorkerStart'));
        $http->on('request', function ($request, $response) {
            if( isset($request->server) ) {
                HttpServer::$server = $request->server;
            }
            if( isset($request->header) ) {
                HttpServer::$header = $request->header;
            }
            if( isset($request->get) ) {
                HttpServer::$get = $request->get;
            }
            if( isset($request->post) ) {
                HttpServer::$post = $request->post;
            }
            // TODO handle img
            ob_start();
            try {
                $result = $this->application->handle()->getContent();
            } catch (Exception $e) {
                if ($config->application->debug) {
                    $result = $e->getMessage() . '<br>';
                    $result .= nl2br(htmlentities($e->getTraceAsString()));
                } else {
                    $result = '500 Internal server error.';
                }
            }
            ob_end_clean();
            echo $result;
        });
        $http->start();
    }
    public function onWorkerStart() {
        define('IN_APP', TRUE);
        define('BASE_PATH', dirname(__FILE__) . '/');
        define('APP_PATH', BASE_PATH . 'app/');
        define('WEB_PATH', dirname(__FILE__) . '/');

        define('TIMESTAMP', time());
        define('DATE_STR', date('Ymd', TIMESTAMP));
        define('TIME_STR', date('r', TIMESTAMP));

        require_once(APP_PATH . 'functions.php');
        $this->config = include APP_PATH . 'config/config.php';

        date_default_timezone_set($this->config->application->timezone);

        include APP_PATH . 'config/loader.php';
        include APP_PATH . 'config/services.php';

        $this->application = new \Phalcon\Mvc\Application($di);
        $moduleBase = $this->config->application->modulesDir;
        $d = dir($moduleBase);
        $modules = array();
        while (FALSE !== ($entry = $d->read())) {
            $path = $moduleBase . $entry . '/Module.php';
            if (is_file($path)) {
                $modules[$entry] = array(
                    'className' => sprintf('App\Modules\%s\Module', ucfirst($entry)),
                    'path' => $path,
                );
            }
        }
        $this->application->registerModules($modules);
    }
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new HttpServer;
        }
        return self::$instance;
    }
}

HttpServer::getInstance();