<?php

namespace App;

use Phalcon\Mvc\View as PhView;
use Phalcon\Mvc\View\Engine\Volt as PhVolt;
use Phalcon\Mvc\View\Engine\Volt\Compiler as PhVoltCompiler;
use Phalcon\DI;

class Volt extends PhVolt
{
    public function getCompiler()
    {
        if (empty($this->_compiler)) {
            $GLOBALS['volt'] = $this;
            $this->_compiler = new VoltCompiler($this->getView());
            $this->_compiler->setOptions($this->getOptions());
            $this->_compiler->setDI($this->getDI());
        }

        return $this->_compiler;
    }
}

class VoltCompiler extends PhVoltCompiler
{
    protected function _compileSource($source, $something = null)
    {
        $variable = '<' . '?php $volt = $GLOBALS[\'volt\']; ?' . '>';
        $compiled = parent::_compileSource($source, $something);

        if (is_array($compiled)) {
            $compiled[0] = $variable . $compiled[0];
            foreach ($compiled as &$entry) {
                $entry = $this->replaceThis($entry);
            }
        } else {
            $compiled = $this->replaceThis($variable . $compiled);
        }

        return $compiled;
    }

    protected function replaceThis($source)
    {
        if (is_array($source)) {
            return $source;
        }

        $source = str_replace('$this', '$volt', $source);
        $source = preg_replace('/function vmacro_([^\)]+)\)[\s]+\{/', 'function vmacro_$1) { global $volt; ', $source);
        return $source;
    }
}

class PhpFunctionExtension
{
    /**
     * This method is called on any attempt to compile a function call
     */
    public function compileFunction($name, $arguments)
    {
        if (function_exists($name)) {
            return $name . '('. $arguments . ')';
        }
    }
}

class View extends PhView
{
    public function __construct(array $options = array())
    {
        parent::__construct($options);

        $this->registerEngines(array(
            '.volt' => function ($this) {
                $di = DI::getDefault();
                $config = $di->getShared('config');
                $volt = new Volt($this, $di);
                $volt->setOptions(
                    array(
                        'compiledPath'      => $config->application->volt->path,
                        'compiledExtension' => $config->application->volt->extension,
                        'compiledSeparator' => $config->application->volt->separator,
                        'stat'              => $config->application->volt->stat,
                    )
                );

                $compiler = $volt->getCompiler();

                $compiler->addFunction('sub_string', function ($resolvedArgs, $exprArgs) {
                    $firstArgument = $compiler->expression($exprArgs[0]['expr']);

                    if (isset($exprArgs[1])) {
                        $secondArgument = $compiler->expression($exprArgs[1]['expr']);
                    } else {
                        $secondArgument = '30';
                    }

                    if (isset($exprArgs[2])) {
                        $thirdArgument = $compiler->expression($exprArgs[2]['expr']);
                    } else {
                        $thirdArgument = ' ...';
                    }

                    return 'App\Helpers\String::truncateUtf8String(' . $firstArgument . ', ' . $secondArgument . ', ' . $thirdArgument . ')';
                })->addFunction('static_url', function ($resolvedArgs, $exprArgs) {
                    return 'App\Helpers\Uri::staticUrl(' . $resolvedArgs . ')';
                })->addFunction('uploaded_url', function ($resolvedArgs, $exprArgs) {
                    return 'App\Helpers\Upload::url(' . $resolvedArgs . ')';
                })->addFunction('weixin_share', function ($resolvedArgs, $exprArgs) {
                    return 'App\Helpers\Weixin::shareCode(' . $resolvedArgs . ')';
                })->addFunction('add_js', function ($resolvedArgs, $exprArgs) {
                    return 'App\Helpers\Uri::assetsJs(' . $resolvedArgs . ')';
                })->addFunction('add_css', function ($resolvedArgs, $exprArgs) {
                    return 'App\Helpers\Uri::assetsCss(' . $resolvedArgs . ')';
                })->addFunction('dump', 'print_r');

                $compiler->addFilter('int', function ($resolvedArgs, $exprArgs) {
                    return 'intval(' . $resolvedArgs . ')';
                })->addFilter('hash', 'md5')->addFilter('capitalize', 'lcfirst');

                $compiler->addExtension(new PhpFunctionExtension());

                return $volt;
            }
        ));
    }
}