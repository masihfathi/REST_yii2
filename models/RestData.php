<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\Link;
use yii\helpers\Url;
class RestData extends Model implements \yii\web\Linkable
{
    public $id;
    public $email;
    public $profile;
    
    private static $users = [
        '100'=>[
            'id'=>100,
            'email'=>'100@example.com',
            'profile'=>[
                'id'=>100,
                'age'=>30,
            ]
        ],
        '200'=>[
            'id'=>200,
            'email'=>'200@example.com',
            'profile'=>[
                'id'=>200,
                'age'=>20,
            ]            
        ]
    ];
//    public function fields()
//    {
//        return[
//            'id',
//            'email'
//        ];
//    }
//    public function extraFields()
//    {
//        return ['profile'];
//    }
    public function primaryKey()
    {
        return 'id';
    }
    public static function findOne($id)
    {
        return isset(self::$users[$id])?new static(self::$users[$id]):null;
    }
    public function getLinks()
    {
        return [
            Link::REL_SELF =>  Url::to(['resttest/view','id'=>$this->id],true),
        ];
    }
}

