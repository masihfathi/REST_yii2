<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $fullname
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $user_login_ip
 * @property string $access_token
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    public function handleAfterLogin($event)
    {     
        $model = self::findOne(Yii::$app->user->id);
        $model->user_login_ip = Yii::$app->request->userIP;
        $model->save();
    }
    public function handleAfterLogout($event)
    {     
        Yii::trace('salam masih');
        //code
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fullname', 'email', 'username', 'password'], 'required'],
            [['fullname', 'email', 'username', 'password','user_login_ip','access_token'], 'string', 'max' => 255],            
            ['user_type','integer'],
            ['email','email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Full Name',
            'email' => 'Email',
            'username' => 'User Name',
            'password' => 'Password',
            'user_login_ip' => 'User Login Ip', 
            'access_token' => 'Access Token',            
            'user_type' => 'User Type',            
        ];
    }
    public function beforeSave($insert)
    {
        $this->password = Yii::$app->security->generatePasswordHash($this->password);
        $this->user_type = 2;
        $this->access_token = Yii::$app->security->generatePasswordHash($this->username.$this->password);
        return parent::beforeSave($insert);    
    }
    public static function findIdentity($id)
    {
        $model = self::findOne($id);
        return $model ? new static($model) : null;
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $model = self::findOne(['access_token' => $token]);
        return $model ? new static($model) : null;                
    }
    public function getId()
    {
        return $this->id;
    }
    public function getAuthKey()
    {
        return null;
    }
    public function validateAuthKey($authKey)
    {
        return null;
    }
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password,$this->password);
    }
    public static function findByUsername($username)
    {
        $model = self::findOne(['LOWER(username)' => strtolower($username)]);
        return $model ? new static($model) : null;        
    }    
    public static function findById($id)
    {
        $model = self::findOne(['id' => $id]);
        return $model ? new static($model) : null;        
    }    
}
