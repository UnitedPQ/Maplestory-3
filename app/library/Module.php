<?php

namespace App;

use Phalcon\DI;
use Phalcon\Loader;
use Phalcon\Config;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    public $id;

    public $config;

    public function __construct()
    {
        $di = DI::getDefault();
        $this->config = $di->getShared('config');
    }

    public function registerAutoloaders()
    {
        $id = $this->id;
        $name = ucfirst($id);

        $loader = new Loader;

        $loader->registerNamespaces(
            array(
                sprintf('App\\Modules\\%s', $name) => $this->config->application->modulesDir . $id . '/library',
                sprintf('App\\Modules\\%s\\Controllers', $name) => $this->config->application->modulesDir . $id . '/controllers',
                sprintf('App\\Modules\\%s\\Models', $name) => $this->config->application->modulesDir . $id . '/models',
                sprintf('App\\Modules\\%s\\Forms', $name) => $this->config->application->modulesDir . $id . '/forms',
                sprintf('App\\Modules\\%s\\Hooks', $name) => $this->config->application->modulesDir . $id . '/hooks',
            )
        );

        $loader->register();
    }

    /**
     * Register specific services for the module
     */
    public function registerServices($di)
    {
        $config = $this->config;
        $id = $this->id;
        $name = ucfirst($id);

        $di->set('dispatcher', function() use ($name) {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace(sprintf("App\\Modules\\%s\\Controllers", $name));
            return $dispatcher;
        });

        $di->set('view', function() use ($id, $config) {
            $view = new View();
            $view->setViewsDir($config->application->modulesDir . $id . '/views/default');
            return $view;
        });


        $configFile = $config->application->modulesDir . $id . '/config/config.php';
        $cfg = new Config(array());
        if (is_file($configFile)) {
            $cfg = include $configFile;
        }
        $di->set('moduleConfig', $cfg);
    }
}