<?php

use yii\helpers\Html;

use app\modules\forum\Module;

$this -> title = Html::encode(Module::getInstance()->params['title']);
//$this -> title = Html::encode($this->context->module->params['title']);
?>
<p><?= date('Y/m/d - H:i:s')?></p>