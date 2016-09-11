<?php

namespace app\components;

use Yii;
use yii\helpers\VarDumper;
use yii\base\Component;

class Debug extends Component
{
    public $type;
    
    public function init() 
    {
        parent::init();
        if(is_null($this->type)){
            $this->type = 'info';
        }
    }
    public function show($var)
    {
        ob_start();
        echo '<div class="alert alert-',  $this->type.'">';
        echo VarDumper::dump($var,10,true);
        echo '</div>'.PHP_EOL;
        return ob_get_clean();                        
    }
}

