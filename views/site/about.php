<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\jui\DatePicker;
use app\widgets\Encode;
use app\widgets\Alert;
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginBlock('time');?>
<p><?= date('l j F Y-H:i:s')?></p>
<?php $this->endBlock();?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>
<p>
<?php if(isset($this->blocks['time'])):?>
    <?= $this->blocks['time']?>
<?php endif;?>
</p>
<p>
<?= DatePicker::widget([
    'name' => 'date',
    'language' =>'fa-IR',
    'dateFormat' => 'yyyy-MM-dd',
])?>
</p>
<!--<p><?php//Encode::widget(['message'=>'<script>hi!'])?></p>-->
<div>
    <?php Encode::begin();?>
    <p>This is sample text</p>
    <script>alert('ok');</script>
    <?php Encode::end();?>
</div>
<?=Alert::widget(['title'=>'Error','message'=>'Not Found','type'=>'success','dissmisable'=>TRUE])?>