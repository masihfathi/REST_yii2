<?php

namespace app\controllers;
use Yii;
use yii\rest\ActiveController;
use app\models\RestData;
use yii\web\Response;
class TestrestController extends ActiveController
{
    //http://localhost/p2/testrest/view/?id=100
    public $modelClass = '\\app\models\RestData';    
    public function behaviors()
    {
        $behaviors=  parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html']=Response::FORMAT_JSON;
        return $behaviors;
    }
    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this,'prepareDataProvider'];
        return $actions;
    }
    public function prepareDataProvider()
    {   
//        $params = Yii::$app->request->queryParams;
//        if (isset($params['username'])) {
//            return Users::findByUsername($params['username']);
//        }else{
//            throw new ParametersNotFound("Parameters dont set properly");
//        }
    }
    public function actionView($id)
    {
        return RestData::findOne($id);
    }
}

