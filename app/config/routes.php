<?php

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Router\Group;

$router = new Router;

$router->setDefaultModule('site');
$router->setDefaultController('index');
$router->setDefaultAction('index');

$router->removeExtraSlashes(TRUE);

$router->add('/([\w\d]+)((/id/[\w\d]+)?(/page/\d+)?)?(\..+)?', array(
    'controller' => 1,
    'params' => 2,
));

$router->add('/([\w\d]+)/([\w\d]+)((/id/[\w\d]+)?(/page/\d+)?)?(\..+)?', array(
    'controller' => 1,
    'action' => 2,
    'params' => 3,
));

$router->add('((/id/[\w\d]+)?(/page/\d+)?)?(\..+)?', array(
    'controller' => 'index',
    'action' => 'index',
    'params' => 1,
));

$moduleBase = $config->application->modulesDir;
$d = dir($moduleBase);
while (FALSE !== ($entry = $d->read())) {
    $routesFile = $moduleBase . $entry . '/Routes.php';
    if (is_file($routesFile)) {
        include_once $routesFile;

        $className = sprintf('App\\Modules\\%s\\Routes', ucfirst($entry));
        $group = new $className;

        if ($group instanceof Group) {
            $router->mount($group);
        }
    }
}