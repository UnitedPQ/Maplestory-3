<?php

namespace App\Modules\Thin\Controllers;

use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;

use App\Helpers\Uri;
use App\Helpers\Prize;
use App\Models\Share;
use App\Models\Thin\Works;

class ActivityController extends ControllerBase
{
    protected $requireLogin = TRUE;

    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        parent::beforeExecuteRoute($dispatcher);

        if ($this->request->isPost()) {
            $startTime = $this->moduleConfig->startTime;
            $endTime = $this->moduleConfig->endTime;

            if (TIMESTAMP < $startTime) {
                $this->json->error('活动将在' . date('Y年m月d日', $startTime) . '开始！');
                $this->response->setContent($this->json->toString());
                $this->response->send();
                return FALSE;
            } elseif (TIMESTAMP > $endTime) {
                $this->json->error('活动已结束！');
                $this->response->setContent($this->json->toString());
                $this->response->send();
                return FALSE;
            }
        }

        return TRUE;
    }

    public function indexAction()
    {
        $redo = $this->request->getQuery('redo');
        if (empty($redo) && ! $this->request->isPost()) {
            $works = Works::fetchLatest($this->currentUser->id);
            if ($works && $works->date == DATE_STR) {
                $this->dispatcher->forward(array(
                    'controller' => 'activity',
                    'action' => 'result',
                ));
            }
        }

        if ($this->request->isPost()) {
            $a = $this->request->getPost('value_a', 'int');
            $b = $this->request->getPost('value_b', 'int');
            $c = $this->request->getPost('value_c', 'int');
            $d = $this->request->getPost('value_d', 'int');
            $e = $this->request->getPost('value_e', 'int');
            $toWeibo = $this->request->getPost('weibo', 'int');

            if (min($a, $b, $c, $d, $e) < 1 || max($a, $b, $c, $d, $e) > 4) {
                $this->json->error('手机还未组装完成！继续DIY吧！');
                return FALSE;
            }

            $aItem = $this->getItem('a', $a);
            $bItem = $this->getItem('b', $b);
            $cItem = $this->getItem('c', $c);
            $dItem = $this->getItem('d', $d);
            $eItem = $this->getItem('e', $e);

            $thickness = $aItem['thickness'] + $bItem['thickness'] + $cItem['thickness'] + $dItem['thickness'] + $eItem['thickness'];
            $total = Works::count();
            $total = max($total, 100);
            $koTotal = Works::count(array(
                'conditions' => 'thickness > :thickness:',
                'bind' => array(
                    'thickness' => $thickness,
                ),
            ));
            $koTotal = max($koTotal, 1);
            $ko = sprintf('%.2f', $koTotal / $total * 100);
            $url = $this->url->get('/thin/');
            $texts = $this->getTexts($thickness);
            
            $search = array('{THICKNESS}', '{KO}', '{URL}');
            $replace = array($thickness, $ko, $url);

            $text1 = str_replace($search, $replace, $texts['text1']);
            $text2 = str_replace($search, $replace, $texts['text2']);

            $success = TRUE;
            if ( ! empty($toWeibo)) {
                $weiboTemplate = $this->moduleConfig->weiboTemplate;
                $status = str_replace($search, $replace, $weiboTemplate);
                $photo = Uri::staticPath('img/weibo.jpg');

                $weibo = $this->auth->weibo();
                $res = $weibo->upload($status, $photo);
                if ( ! empty($res['error_code'])) {
                    $this->json->error($res['error']);
                    $success = FALSE;
                }
            }

            if ($success) {
                $works = new Works;
                $works->assign(array(
                    'userId' => $this->currentUser->id,
                    'nickname' => $this->currentUser->nickname,
                    'a' => $a,
                    'b' => $b,
                    'c' => $c,
                    'd' => $d,
                    'e' => $e,
                    'thickness' => $thickness,
                    'ko' => $ko,
                    'text1' => $text1,
                    'text2' => $text2,
                    'weibo' => $toWeibo ? json_encode($res) : NULL,
                    'date' => DATE_STR,
                ));
                $works->save();
                
                if ($this->stat->weiboDate != DATE_STR) {
                    $this->stat->drawAdd(3, 'weibo');
                }

                $this->json->success('你已成功组装出你的个性手机，赶紧看看有多薄吧~');
            }
        }
    }

    public function resultAction()
    {
        $works = Works::fetchLatest($this->currentUser->id);
        if (empty($works) || empty($works->id)) {
            $this->response->redirect($this->url->get('/thin/activity/'));
            $this->response->send();
        }

        $this->view->setVars(array(
            'works' => $works,
        ));
    }

    public function drawAction()
    {
        if ($this->request->isPost()) {
            $noShare = $this->stat->shareDate != DATE_STR;

            if ($this->stat->drawUse()) {
                $this->stat->refresh();

                $prize = Prize::raffle(array(
                    'module' => $this->moduleName,
                    'startTime' => $this->moduleConfig->startTime,
                    'endTime' => $this->moduleConfig->endTime,
                ));

                if ($prize->isLuck) {
                    $this->json->success('人品爆发，恭喜你获得一' . $prize->unit . $prize->name . '。点击我要兑奖完善中奖信息。');
                } else {
                    $message = '很遗憾，你没有中奖，继续努力吧~';

                    if ($this->stat->drawLeft == 2) {
                        $message = '差了那么一丢丢运气，还剩2次抽奖机会！';
                    } elseif ($this->stat->drawLeft == 1) {
                        $message = '很遗憾，没有中奖。还剩1次抽奖机会！';
                    } elseif ($this->stat->drawLeft == 0) {
                        if ($noShare) {
                            $message = '抽奖机会已用完，分享攒人品，将额外获得3次机会！';
                        } else {
                            $message = '您今天的抽奖机会已经用完，明天再来吧！';
                        }
                    }

                    $this->json->success($message);
                }
                
                $this->json->set('id', $prize->id);
                $this->json->set('isLuck', (boolean) $prize->isLuck);
                $this->json->set('result', $prize->extra('result'));
            } else {
                if ($noShare) {
                    $message = '抽奖机会已用完，分享攒人品，将额外获得3次机会！';
                } else {
                    $message = '您今天的抽奖机会已经用完，明天再来吧！';
                }

                $this->json->error($message);
            }

            $this->json->set('noShare', $noShare);
            $this->json->set('drawLeft', $this->stat->drawLeft);
        }
    }

    public function shareAction()
    {
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $weibo = $this->auth->weibo();

        if ($this->request->isPost()) {
            $status = $this->session->get('thin_shareStatus');
            if (empty($status)) {
                $this->json->error('出错了，请重试！');
            } else {
                $photo = Uri::staticPath('img/weibo.jpg');
                $res = $weibo->upload($status, $photo);

                if (empty($res['error_code'])) {
                    $share = new Share;
                    $share->userId = $this->currentUser->id;
                    $share->nickname = $this->currentUser->nickname;
                    $share->module = $this->moduleName;
                    $share->date = DATE_STR;
                    $share->type = 'weibo';
                    $share->data = json_encode($res);
                    $share->userAgent = $this->request->getUserAgent();
                    $share->ipAddress = $this->request->getClientAddress();
                    $share->save();

                    if ($this->stat->shareDate != DATE_STR) {
                        $this->stat->drawAdd(3, 'share');
                        $this->stat->refresh();
                    }

                    $this->json->success('分享成功！');
                    $this->json->set('drawLeft', $this->stat->drawLeft);
                } else {
                    $this->json->error($res['error']);
                }
            }
        } else {
            $works = Works::fetchLatest($this->currentUser->id);
            $template = $this->moduleConfig->shareTemplate;
            $url = $this->url->get('/thin/');

            $page = mt_rand(1, 5);
            $res = $weibo->bilateral($this->user->openId, $page, 5);

            $friendStr = '';
            if (empty($res['error_code'])) {
                $users = $res['users'];
                $friends = array();
                $num = 1;
                foreach ($users as $user) {
                    if ($num >= 4)
                        break;

                    $friends[] = '@' . $user['name'];
                    $num += 1;
                }
                $friendStr = implode(' ', $friends);
            }

            $search = array('{THICKNESS}', '{KO}', '{URL}', '{FRIENDS}');
            $replace = array($works->thickness, $works->ko, $url, $friendStr);
            $status = str_replace($search, $replace, $template);

            $this->session->set('thin_shareStatus', $status);

            $this->view->setVars(array(
                'status' => $status,
            ));
        }
    }

    private function getItem($type, $id)
    {
        $components = (array) $this->moduleConfig->components;
        $items = isset($components[$type]['items']) ? $components[$type]['items'] : array();
        return isset($items[$id]) ? $items[$id] : $items[1];
    }

    private function getTexts($thickness)
    {
        $templates = (array) $this->moduleConfig->templates;
        if (isset($templates[$thickness.'mm'])) {
            return (array) $templates[$thickness.'mm'];
        } else {
            foreach ($templates as $template) {
                $template = (array) $template;
                $max = array_get($template, 'max', 0);
                $min = array_get($template, 'min', 0);

                if ($min <= $thickness && $thickness < $max)
                    return $template;
            }
        }

        return array('text1' => NULL, 'text2' => NULL);
    }
}