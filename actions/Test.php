<?php

namespace app\actions;

use Yii;
use yii\base\Action;

class Test extends Action
{
    public $message;
    public function init() 
    {
        parent::init();
        if(is_null($this->message)){
            $this->message = 'Hello World';
        }
    }
    public function run()
    {
//        $this->controller->view->title = 'test';
        return $this->controller->render('test',[
            'message' => $this->message
        ]); 
//        return $this->controller->renderContent($this->message);
    }
}

