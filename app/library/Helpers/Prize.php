<?php

namespace App\Helpers;

use App\Models\Prize as PrizeModel;
use App\Models\DrawResult;

class Prize extends HelperBase
{
    private static $list;

    private static $weight;

    private static $luckList;

    private static $luckWeight;

    private static $lostList;

    private static $lostWeight;

    public static function getList($module, $activityId = 0)
    {
        self::parseList($module, $activityId);

        return self::$list;
    }

    public static function getLuckList($module, $activityId = 0)
    {
        self::parseList($module, $activityId);

        return self::$luckList;
    }

    public static function raffle($options = array())
    {
        $module = array_get($options, 'module');
        $activityId = array_get($options, 'activityId', 0);
        $startTime = array_get($options, 'startTime', 0);
        $endTime = array_get($options, 'endTime', 9999999999);

        self::parseList($module, $activityId);
        if (count(self::$luckList) <= 0 || count(self::$lostList) <= 0)
            return NULL;

        $auth = self::getShared('auth');
        if ($startTime > TIMESTAMP || $endTime < TIMESTAMP || ! $auth->isLogined()) {
            $prize = self::getLostPrize();
            return $prize;
        }

        $userId = $auth->getId();
        $nickname = $auth->getName();

        $count = DrawResult::sum(array(
            'conditions' => 'userId = :userId:',
            'bind' => array(
                'userId' => $userId,
            ),
            'column' => 'isLuck',
        ));
        $max = DrawResult::sum(array(
            'conditions' => 'userId = :userId:',
            'bind' => array(
                'userId' => $userId,
            ),
            'column' => 'isMobile',
        ));

        $maxNum = (100 + $max * 900) * $count;
        $num1 = mt_rand(0, $maxNum);
        $num2 = mt_rand(0, $maxNum);
        if ($num1 != $num2) {
            $prize = self::getLostPrize();
        } else {
            $prize = self::getPrize();

            $currentTotal = round((TIMESTAMP - $startTime) / ($endTime - $startTime) * $prize->total);
            $currentTotal = min($currentTotal, $prize->total);
            if ($prize->count >= $currentTotal) {
                $prize = self::getLostPrize();
            } else {
                if ( ! $prize->raffle()) {
                    $prize = self::getLostPrize();
                }
            }
        }

        $result = new DrawResult;
        $result->module = $module;
        $result->activityId = $activityId;
        $result->userId = $userId;
        $result->nickname = $nickname;
        $result->date = date('Ymd', TIMESTAMP);
        $result->prizeId = $prize->id;
        $result->isLuck = $prize->isLuck;
        $result->isMobile = $prize->isMobile;
        $result->isCoupon = $prize->isCoupon;
        $result->deadline = array_get($options, 'deadline', 0);

        if ($result->save())
            return $prize;
        else
            return self::getLostPrize();
    }

    private static function getLostPrize()
    {
        $prizeId = self::randId(self::$lostWeight);
        return self::$lostList[$prizeId];
    }

    private static function getPrize()
    {
        $prizeId = self::randId(self::$weight);
        return self::$list[$prizeId];
    }

    private static function randId($weights)
    {
        $total = array_sum($weights);
        $num = mt_rand(min(1, $total), $total);
        $lastMin = 0;
        $result = 0;
        foreach ($weights as $id => $weight) {
            if (($lastMin < $num) && ($num <= $lastMin + $weight)) {
                $result = $id;
            }
            $lastMin += $weight;
        }
        return $result;
    }

    private static function parseList($module, $activityId = 0)
    {
        if ( ! isset(self::$list)) {
            $conditions = 'module = :module:';
            $bind = array('module' => $module);

            if ($activityId > 0) {
                $conditions .= ' AND activityId = :activityId:';
                $bind['activityId'] = $activityId;
            }

            $prizeList = PrizeModel::find(array(
                'conditions' => $conditions,
                'bind' => $bind,
                'order' => 'sort DESC',
            ));

            $list = array();
            $weight = array();
            $luckList = array();
            $luckWeight = array();
            $lostList = array();
            $lostWeight = array();

            foreach ($prizeList as $prize) {
                $list[$prize->id] = $prize;
                $weight[$prize->id] = $prize->weight;

                if ($prize->isLuck) {
                    $luckList[$prize->id] = $prize;
                    $luckWeight[$prize->id] = $prize->weight;
                } else {
                    $lostList[$prize->id] = $prize;
                    $lostWeight[$prize->id] = $prize->weight;
                }
            }

            self::$list = $list;
            self::$weight = $weight;
            self::$luckList = $luckList;
            self::$luckWeight = $luckWeight;
            self::$lostList = $lostList;
            self::$lostWeight = $lostWeight;
        }
    }
}