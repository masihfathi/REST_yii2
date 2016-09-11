<?php
use yii\helpers\HtmlPurifier;
$this->title = 'validate-form';
?>
<p>You have entered the following data</p>
<ul>
    <li><strong>Name:  </strong> <?= HtmlPurifier::process($model->name)?></li>
    <li><strong>Family:</strong> <?=  HtmlPurifier::process($model->family)?></li>
    <li><strong>Age:   </strong> <?=   HtmlPurifier::process($model->age)?></li>
    <li><strong>Gender:</strong> <?=  HtmlPurifier::process($model->gender)?></li>
    <li><strong>Email: </strong> <?=   HtmlPurifier::process($model->email)?></li>
    <li><strong>Date: </strong> <?=   HtmlPurifier::process($model->date)?></li>
</ul>


