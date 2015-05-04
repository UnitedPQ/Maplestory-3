<?php
$loader = new \Phalcon\Loader();

$loader->registerNamespaces(array(
    'App\Models'      => $config->application->modelsDir,
    'App\Modules'     => $config->application->modulesDir,
    'App'             => $config->application->libraryDir,
));

$loader->register();

// Use composer autoloader to load vendor classes
if (is_file(__DIR__ . '/../../vendor/autoload.php'))
    require_once __DIR__ . '/../../vendor/autoload.php';