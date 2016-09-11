<?php

$this->title = $message;
use yii\bootstrap\Alert;
?>
<?php Alert::begin([
    'options' => [
        'class' => 'alert-info',
    ],
    'closeButton' => FALSE,
]);?>

<?= $message ?>

<?php
Alert::end();
?>

