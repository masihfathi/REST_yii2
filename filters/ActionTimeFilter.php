<?php

namespace app\filters;

use Yii;
use yii\base\ActionFilter;

class ActionTimeFilter extends ActionFilter
{
    private $_startTime;
    
    public function beforeAction($action)
    {
        $this->_startTime = microtime(TRUE);
        return parent::beforeAction($action);      
    }
    public function afterAction($action,$result)
    {
        $time = microtime(TRUE)- $this->_startTime;
        Yii::trace("Action '{$action->uniqueId}' Spent {$time}");
        return parent::afterAction($action, $result);
    }
}

