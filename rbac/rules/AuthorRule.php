<?php

namespace app\rbac\rules;
use Yii;
use yii\rbac\Rule;

class AuthorRule extends Rule
{
    public $name='isAuthor';
    public function execute($user, $item, $params)
    {
        return isset($params['post'])?$params['post']->createdBy==$user->id:FALSE;
    }
}

