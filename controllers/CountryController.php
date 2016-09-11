<?php

namespace app\controllers;
use Yii;
 
use yii\rest\ActiveController;
 


class CountryController extends ActiveController
{
    //http://localhost/p2/country
    public $modelClass = '\\app\models\Countires'; 
    
}

