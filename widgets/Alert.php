<?php

namespace app\widgets;

use yii\helpers\Html;
use yii\base\Widget;

class Alert extends Widget
{
    public $type;
    public $title;
    public $message;
    public $dissmisable;
    
    public function init()
    {
        parent::init();
        
        if(is_null($this->type)){
            $this->type = 'info';
        }
        if(is_null($this->title)){
            $this->title = '&nbsp';
        }
        if(is_null($this->message)){
            $this->message = '&nbsp';
        }
        if(is_null($this->dissmisable)){
            $this->dissmisable = FALSE;
        }
    } 
    public function run()
    {
        $message = ($this->message != '&nbsp') ? Html::encode($this->message):$this->message;
        $title = ($this->title != '&nbsp') ? Html::encode($this->title):$this->title;
        $type = (in_array($this->type, ['info','success','danger','warning'])) ? ' alert-'.$this->type : '';
        $dissmisable = ($this->dissmisable === TRUE);
        if($dissmisable){
            echo <<<EOT
            <div class="alert{$type} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>         
EOT;
            
        }else{
            echo '<div class="alert'.$type.'">'.PHP_EOL;
        }
//        echo '<h3>'.$title.'</h3>'.PHP_EOL;
//        echo '<hr />'.PHP_EOL;
//        echo '<p>'.$message.'</p>'.PHP_EOL;
//        echo '</div>'.PHP_EOL;
        echo <<<EOT
        <h4>{$title}</h4>
        <hr />
        <p>$message</p>
        </div>       
                
EOT;
        
    }
}

