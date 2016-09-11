<?php
namespace app\models;

use yii\base\Model;

class EntryForm extends Model
{
    public $name;
    public $family;
    public $age;
    public $gender;
    public $email;
    public $date;
    public function rules()
    {
        return[
            [['name','family','email'],'required'],
            [['name','family'],'string','max'=>255],
            ['email','email'],
            ['age','integer'],
            ['gender','match','pattern'=>'#^((?:man|femail))$#i'],
            ['date','date', 'format' => 'yyyy-MM-dd'],
        ];   
    }
    
}

