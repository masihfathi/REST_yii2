<?php 
 
namespace app\models;
 
use Yii;

class Countires extends  \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countires';
    }
 
    /**
     * @inheritdoc
     */
    public static function primaryKey()
    {
        return ['code'];
    }
 
    /**
     * Define rules for validation
     */
    public function rules()
    {
        return [
            [['code', 'name', 'population'], 'required']
        ];
    }
}