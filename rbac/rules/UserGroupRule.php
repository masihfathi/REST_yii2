<?php

namespace app\rbac\rules;
use Yii;
use yii\rbac\Rule;

class UserGroupRule extends Rule
{
    public $name='userGroup';
    public function execute($user, $item, $params)
    {
        // $item is the asscocieted parent
        if(!Yii::$app->user->isGuest){
            $group = Yii::$app->user->identity->user_type;
            // ex:$group=1 ke admin ast
            if($item->name==='admin'){
                return $group==1;
            }elseif ($item->name==='author') {
                return $group==1|$group==2;
            }            
        }
        return false;
    }
}

