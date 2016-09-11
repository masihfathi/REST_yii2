<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use yii\web\HttpException;
use app\models\Users;
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
           'access2'=>  [
               // faghat dar roz 08-09 kasani ke login na kardaand ejaze dastresi be action about ra darand
                'class' => AccessControl::className(),
                'only' => ['about'],
                'rules' => [
                    [
                        // rbac with defauthRoles in config/web.php 
                        // check role, rule_name and then select rule from rbac_rule and then check rule
                        'roles' => ['author'],
                        'allow' => true,
                        'matchCallback'=> function ($rule,$action){
                         return 1;
//                            return date('d-m') ==='08-09';
                        },                    
                    ],
                ],
                'denyCallback' => [$this,'actionDeny'],
            ],                            
            'access3'=> [            
                'class' => 'app\filters\ActionTimeFilter',
                'only' => ['index'],
            ],
            'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'logout' => ['post'],
                    ],
            ],                             
        ];                   
    }
    public function actionRegister()
    {
        $model = new Users();
        if($model->load(Yii::$app->request->post())&& $model->save()){
            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole('author');
            $auth->assign($authorRole, $model->id);
            $this->redirect(['/site/login']);
        }
        return $this->render('register',compact('model'));
    }    
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'test' => [
                'class' => 'app\actions\Test',
                'message' => Yii::$app->request->get('message'),
                ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function actionDeny()
    {
//        $this->goHome();
        throw new HttpException(400,'invalid request');
        //return $this->render('deny');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($lang='fa')
    {
        if(isset(Yii::$app->params['validLangs'][$lang])){
            Yii::$app->language = Yii::$app->params['validLangs'][$lang];
        }else{            
            Yii::$app->language='en-US';
        }
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {          
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    public function actionToken() {
//http://localhost/p2/web/index.php?r=site%2Ftoken&tokenid=4bd85c0060b19b3e51665f1523ec7559        
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }        
        $model = new LoginForm();        
        $tokenid = Yii::$app->request->get('tokenid');
        if($model->loginAccessToken($tokenid)){
            return $this->goHome();
        }
        throw new HttpException(400,'Invalid Requset');
    }    

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();                 
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $this->view->params['keywords'] = 'yii, framework, php';
        return $this->render('about');
    }
    public function actionSay($message='Hello')
    {
        return $this->render('say', ['message'=>$message]);
    }
    public function actionEntry()
    {
        $model = new EntryForm;
        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            $this->layout = 'test';
            return $this->render('entry-form',['model'=>$model]);
        }
        return $this->render('entry',['model'=>$model]);                       
    }

}
