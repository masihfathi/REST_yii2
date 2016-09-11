<?php

namespace app\modules\forum\controllers;

use Yii;

use yii\web\Controller; 

class PostController extends Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => 'app\filters\ActionTimeFilter',
            ],            
//            'cache' => [
//                'class' => 'yii\filters\HttpCache',
//                'only' => ['index','view'],
//                'lastModified' => function ($action,$view){
//                $q = new \yii\db\Query;
//                return $q->from('countires')-> max('population');
//                },                
//            ],
        ];
        
    }
    public function actionIndex()
    {
        return $this->render('index');        
    }
}

