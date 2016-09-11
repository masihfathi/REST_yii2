<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class Encode extends Widget
{
//    public $message;
//    
//    public function init()
//    {
//        parent::init();
//        if (is_null($this->message)) {
//            $this->message = 'Hello World';
//        }
//    }
//    public function run()
//    {
//        return Html::encode($this->message);
//    }    
    public function init()
    {
        parent::init();
        ob_start();
    }
    public function getViewPath()
    {
        return '@app/widgets/views/encode';
    }
    public function run()
    {
        return $this->render('index', ['content'=>rtrim(Html::encode(ob_get_clean()))]) ;
    }    
}

