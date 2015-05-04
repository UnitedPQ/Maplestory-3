<?php

namespace App;

use Phalcon\Mvc\Controller as PhController;
use Phalcon\Mvc\Dispatcher as PhDispatcher;
use Phalcon\Mvc\View as PhView;

use App\Models\ModuleLogin;
use App\Models\ViewLog;

class Controller extends PhController
{
    protected $requireLogin = FALSE;
    protected $loginTypes = array('weibo', 'weixin');
    protected $_isJsonResponse = FALSE;

    protected $currentUser;

    protected $nextUrl;

    protected $noWap = FALSE;

    protected $logIt = TRUE;

    public function beforeExecuteRoute(PhDispatcher $dispatcher)
    {
        if ($this->logIt && ! $dispatcher->wasForwarded())
            $this->logView();

        if ($this->requireLogin)
            $this->checkLogin();

        $currentUri = $_SERVER["REQUEST_URI"];
        $res = preg_match('/^.+\.(\w+)(\?.*)?$/', $currentUri, $matches);
        if ($res && $matches[1] == 'json') {
            $this->view->disable();
            $this->_isJsonResponse = TRUE;
        }

        if ($this->userAgent->isMobile() && empty($this->noWap)) {
            $viewsDir = $this->view->getViewsDir();
            $viewsDir = rtrim($viewsDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . '../mobile';
            $this->view->setViewsDir($viewsDir);
        }

        if ( ! empty($_SERVER['HTTP_X_PJAX']))
            $this->view->setRenderLevel(PhView::LEVEL_ACTION_VIEW);

        if ($this->auth->isLogined()) {
            $userId = $this->auth->getId();
            $this->currentUser = $this->auth->user();

            if ($this->currentUser->openId == '1809745371')
                die('抱歉，你不能进行活动，你现在使用的帐号是“vivo智能手机”！');

            if (empty($this->currentUser) || empty($this->currentUser->id)) {
                $this->checkLogin(NULL, TRUE);
            }

            $moduleName = $dispatcher->getModuleName();
            $loginCount = ModuleLogin::count(array(
                'conditions' => 'userId = :userId: AND module = :module:',
                'bind' => array(
                    'userId' => $userId,
                    'module' => $moduleName,
                ),
            ));
            if (empty($loginCount)) {
                $loginLog = new ModuleLogin;
                $loginLog->userId = $userId;
                $loginLog->nickname = $this->currentUser->nickname;
                $loginLog->module = $moduleName;
                @$loginLog->save();
            }
        }

        $this->view->setVar('isPageApp', $this->auth->isPageApp());
        $this->view->setVar('isMobile', (bool) $this->userAgent->isMobile());
        $this->view->setVar('isWeixin', (int) $this->userAgent->isWeixin());
        $this->view->setVar('currentUser', $this->currentUser);
        $this->view->setVar('moduleName', $dispatcher->getModuleName());

        return TRUE;
    }

    public function afterExecuteRoute(PhDispatcher $dispatcher)
    {
        if ($this->_isJsonResponse) {
            $this->response->setContent($this->json->toString());
            $this->response->send();
        }
    }

    public function getCurrentUser()
    {
        return $this->currentUser;
    }

    protected function checkLogin($nextUrl = NULL, $force = FALSE)
    {
        if ($this->auth->isLogined() && ! $force) {
            $loginType = $this->auth->getIdentity('type');

            if (in_array($loginType, $this->loginTypes))
                return TRUE;
            else
                $this->auth->logout();
        }

        if (is_null($nextUrl)) {
            $nextUrl = $this->nextUrl ? $this->nextUrl : $this->dispatcher->getCurrentURI();
        }

        $authorizeUrl = NULL;
        if (in_array('weixin', $this->loginTypes)) {
            $authorizeUrl = $this->url->get('/auth/weixin/', array(
                'next' => $nextUrl,
            ));
        }

        if (in_array('weibo', $this->loginTypes)) {
            if ( ! in_array('weixin', $this->loginTypes) && $this->userAgent->isWeixin()) {
                //$authorizeUrl = $this->url->get('/auth/weixin/toWeibo/', array(
                $authorizeUrl = $this->url->get('/auth/weibo/', array(
                    'next' => $nextUrl,
                ));
            } elseif ( ! in_array('weixin', $this->loginTypes) || ! $this->userAgent->isWeixin()) {
                $authorizeUrl = $this->url->get('/auth/weibo/', array(
                    'next' => $nextUrl,
                ));
            }
        }

        if ( ! empty($authorizeUrl)) {
            $this->response->redirect($authorizeUrl);
            $this->response->send();
        }

        return TRUE;
    }

    protected function show404()
    {
        $this->dispatcher->forward(array(
            'controller' => 'error',
            'action' => 'notfound',
        ));
    }

    protected function error($content = NULL)
    {
        if ($content) {
            $this->view->disable();
            $this->response->setContent($content);
        }
        $this->response->send();
        exit;
    }

    protected function logView($page = NULL)
    {
        if (empty($page)) {
            $controllerName = $this->dispatcher->getControllerName();
            $actionName = $this->dispatcher->getActionName();

            $page = $controllerName . '/' . $actionName;
        }

        $viewLog = new ViewLog;
        $viewLog->userId = $this->auth->getId();
        $viewLog->nickname = $this->auth->getName();
        $viewLog->module = $this->dispatcher->getModuleName();
        $viewLog->page = $page;
        $viewLog->url = $this->dispatcher->getCurrentURI();
        $viewLog->ipAddress = $this->request->getClientAddress();
        $viewLog->userAgent = $this->request->getUserAgent();
        @$viewLog->save();

        return TRUE;
    }

    protected function runHook($hook, $action, $params = array())
    {
        $tmpArr = explode('/', $hook);

        if (count($tmpArr) > 1) {
            $module = $tmpArr[0];
            $hook = $tmpArr[1];
        } else {
            $module = $this->dispatcher->getModuleName();
            $hook = $tmpArr[0];
        }

        $hookName = ucfirst($hook);
        $hookFile = $this->config->application->modulesDir . $module . '/hooks/' . $hookName . '.php';
        if (is_file($hookFile)) {
            require_once($hookFile);

            $hookClass = sprintf('App\\Modules\\%s\\Hooks\\%s', ucfirst($module), $hookName);
            $hook = new $hookClass;
            $hook->setController($this);

            if (method_exists($hook, $action)) {
                return call_user_func_array(array($hook, $action), $params);
            }
        }

        return FALSE;
    }
}