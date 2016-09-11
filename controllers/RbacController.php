<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
//        // add 'createPost' permission
//        $createPost = $auth->createPermission('createPost');
//        $createPost->description='create a post';
//        $auth->add($createPost);
//        // add 'updatePost' permission
//        $updatePost = $auth->createPermission('updatePost');
//        $updatePost->description='update a post';
//        $auth->add($updatePost);
//        // add 'author' role and give the role to the 'createPost' permission
//        $author = $auth->createRole('author');
//        $auth->add($author);
//        $auth->addChild($author, $createPost);
//        // add 'admin' role and give this role to the 'updatePost' permission
//        // as well as the permission of the 'author' role
//        $admin = $auth->createRole('admin');
//        $auth->add($admin);
//        $auth->addChild($admin, $author);        
//        $auth->addChild($admin, $updatePost); 
//        // assign roles to the users
//        // 1 and 2 are the IDs returned by IdentityInterface::getId()
//        // usally implemented in your User model
//        $auth->assign($author, 2);
//        $auth->assign($admin, 1);   
//        // add 'AuthorRule' rule to the rbac_rule table
//        $rule = new \app\rbac\rules\AuthorRule;
//        $auth->add($rule);
//        // add the 'updateOwnPost' permission and associate the rule with it
//        $updateOwnPost = $auth->createPermission('updateOwnPost');
//        $updateOwnPost->description = 'update Own Post';
//        $updateOwnPost->ruleName = $rule->name;
//        $auth->add($updateOwnPost);
//        // 'updateOwnPost' will be used from 'updatePost'
//        $updatePost = $auth->getPermission('updatePost');
//        $auth->addChild($updateOwnPost, $updatePost);
//        // allow 'author' to update there own post
//        $author = $auth->getRole('author');
//        $auth->addChild($author,$updateOwnPost);
        $rule = new \app\rbac\rules\UserGroupRule;
        $auth->add($rule);
        $author = $auth->getRole('author');
        $author->ruleName=$rule->name;
        $auth->update('author', $author);
        // add permission as children of $author
        $admin = $auth->getRole('admin');
        $admin->ruleName=$rule->name;
        $auth->update('admin', $admin);        
    }
}

