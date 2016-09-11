<?php

namespace app\controllers;
use Yii;
use yii\rest\ActiveController;
use yii\web\Response;
use app\models\Users;
use app\exception\ParametersNotFound;
use app\models\LoginForm;
class UserController extends ActiveController
{
    public $modelClass = '\\app\models\Users'; 
    public function behaviors()
    {
        $behaviors= parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html']=Response::FORMAT_XML;
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
        $params = Yii::$app->request->queryParams;
        if (isset($params['username'])) {
            return Users::findByUsername($params['username']);
        }else{
            throw new ParametersNotFound("Parameters dont set properly");
        }
    }
    public function actionLogin()
    {
//http://localhost/p2/user/login/?tokenid=$2y$13$ekhOdOgq6PJi11UjSclPB.j0NavtQN05DoC449iStlIpW0J.zx4wa         
        $model = new LoginForm();        
        $tokenid = Yii::$app->request->get('tokenid');
        if($model->loginAccessToken($tokenid)){
            return Yii::$app->user->identity->email;            
        }else{
            throw new ParametersNotFound("Parameters dont set properly");
        }       
    }
    
}

