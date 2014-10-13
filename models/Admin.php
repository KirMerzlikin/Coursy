<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $email
 * @property string $passHash
 * @property string $name
 */
class Admin extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'passHash', 'name'], 'required'],
            [['email', 'passHash', 'name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'passHash' => 'Pass Hash',
            'name' => 'Name',
        ];
    }

    public static function findByEmail($email)
    {
        $admin = Admin::find()->where(['email' => $email])->one();
        return $admin;
    }

    public function validatePassword($password)
    {
       return $this->passHash == md5($password);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        $admin = Admin::find()->where(['passHash' => $token])->one();
        return $admin; 
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->email;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->email === $authKey;
    }

     public static function findIdentity($id)
    {
        $admin = Admin::find()->where(['id' => $id])->one();
        return $admin;
    }
}
