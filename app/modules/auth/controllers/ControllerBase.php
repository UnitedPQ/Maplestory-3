<?php

namespace App\Modules\Auth\Controllers;

use Phalcon\Mvc\Dispatcher;

use App\Controller;

class ControllerBase extends Controller
{
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        parent::beforeExecuteRoute($dispatcher);

        $nextUrl = $this->request->get('next');
        $scope = $this->request->get('scope');

        if ($nextUrl || $scope) {
            $this->session->set('nextUrl', $nextUrl);
            $this->session->set('scope', $scope);
        }

        return TRUE;
    }

    protected function redirect()
    {
        $nextUrl = $this->session->get('nextUrl');
        if (empty($nextUrl)) {
            $nextUrl = $this->url->get('/');
        }

        $this->session->remove('nextUrl');
        $this->session->remove('scope');
        $this->response->redirect($nextUrl);
        $this->response->send();
    }
}