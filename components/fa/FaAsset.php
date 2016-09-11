<?php

namespace app\components\fa;

use Yii;
use yii\web\AssetBundle;

class FaAsset extends AssetBundle
{
    public $sourcePath = '@app/components/fa';
    
    public $css = [
      'css/font-awesome.min.css'  ,
    ];
    public $publishOnly = [
        'fonts/',
        'css/',
    ];
}

