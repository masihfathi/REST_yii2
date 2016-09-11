<?php
use yii\jui\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\Draggable;
use yii\jui\Droppable;
use yii\jui\Spinner;
use yii\jui\SliderInput;
$this->title = 'form';
?>
<?php
Draggable::begin([
    'clientOptions' => ['grid' => [50, 20]],
]);?>
<?='masih fathi'?>
<?php Draggable::end();?>
<?php
Droppable::begin([
    'clientOptions' => ['accept' => '.special'],
]);?>
<?php
echo 'Droppable body here...';
?>
<?php
Droppable::end();
?>
<?php
echo Spinner::widget([
    'model' => $model->name,
    'attribute' => 'country',
    'clientOptions' => ['step' => 2],
]);
?>
<?php $form =ActiveForm::begin();?>
    <?=$form->field($model, 'name')?>
    <?=$form->field($model, 'family')?>
    <?=$form->field($model, 'age') -> widget(SliderInput::className(),[
        'clientOptions' => [
        'min' => 1,
        'max' => 100,
         ],        
    ])?>
    <?=$form->field($model, 'gender')?>
    <?=$form->field($model, 'email')?>
    <p>
        <?=$form->field($model, 'date') -> widget(DatePicker::classname(), [
            'language' =>'fa-IR',
            'dateFormat' => 'yyyy-MM-dd',
        ]
        )?>
    </p>
<?= Html::submitButton('Submit',['class'=>'btn btn-primary'])?>
<?php ActiveForm::end();?>

