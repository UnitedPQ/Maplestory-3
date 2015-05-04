<?php
error_reporting(E_ALL);
ob_start();

if ( ! function_exists("fastcgi_finish_request")) {
    function fastcgi_finish_request() { return TRUE; }
}

/**
 * Define some useful constants
 */
define('IN_APP', TRUE);
define('BASE_PATH', dirname(__DIR__) . '/');
define('APP_PATH', BASE_PATH . 'app/');
define('WEB_PATH', dirname(__FILE__) . '/');

define('TIMESTAMP', time());
define('DATE_STR', date('Ymd', TIMESTAMP));
define('TIME_STR', date('r', TIMESTAMP));

require_once(APP_PATH . 'functions.php');

/**
 * Read the configuration
 */
$config = include APP_PATH . 'config/config.php';

try {
    date_default_timezone_set($config->application->timezone);

    /**
     * Read auto-loader
     */
    include APP_PATH . 'config/loader.php';

    /**
     * Read services
     */
    include APP_PATH . 'config/services.php';

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    $moduleBase = $config->application->modulesDir;
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
    $application->registerModules($modules);

    echo $application->handle()->getContent();

} catch (Exception $e) {
    if ($config->application->debug) {
        echo $e->getMessage(), '<br>';
        echo nl2br(htmlentities($e->getTraceAsString()));
    } else {
        echo '500 Internal server error.';
    }
}