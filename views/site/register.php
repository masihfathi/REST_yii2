<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title='Register';
?>
<div class="alert alert-success">
    <h1><?= $this->title ?></h1>
    <hr />
    <?php $form= ActiveForm::begin([
        'id'=>'register-form',
        'enableAjaxValidation'=>false,
        'layout'=>'horizontal',
        'fieldConfig'=>[
            'template'=>"{label}\n <div class=\"col-sm-5\">{input}</div>\n<div class=\"col-sm-5\">{error}</div>",
            'labelOptions'=>[
                'class'=>'col-sm-2 control-label',
                ],
        ]
    ]);?>
    <?= $form->field($model, 'fullname')?>
    <?= $form->field($model, 'email')?>
    <?= $form->field($model, 'username')?>
    <?= $form->field($model, 'password')->passwordInput()?>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-5">
            <?= Html::submitButton('Register', ['class'=>'btn btn-success btn-block'])?>
        </div>
    </div>
    <?php ActiveForm::end();?>
</div>

