<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lecturer".
 *
 * @property integer $id
 * @property integer $active
 * @property string $name
 * @property string $email
 * @property string $passHash
 * @property integer $idDepartment
 * @property string $degree
 *
 * @property Course[] $courses
 * @property Department $idDepartment0
 */
class Lecturer extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lecturer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active', 'name', 'email', 'passHash', 'idDepartment'], 'required'],
            [['active', 'idDepartment'], 'integer'],
            [['name', 'email', 'passHash', 'degree'], 'string', 'max' => 255],
            ['name', 'match', 'pattern'=>'/[a-zA-Zа-яёА-Я][a-zA-Zа-яёА-Я\\s-]+$/', 'message' => 'Пожалуйста, введите корректное имя'],
            ['degree', 'match', 'pattern'=>'/[a-zA-Zа-яёА-Я][a-zA-Zа-яёА-Я\\s-]+$/', 'message' => 'Пожалуйста, введите корректное звание'],
            ['email', 'email', 'message' => 'Пожалуйста, введите корректный email'],
            ['email', 'validateEmail']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'active' => 'Active',
            'name' => 'Name',
            'email' => 'Email',
            'passHash' => 'Pass Hash',
            'idDepartment' => 'Id Department',
            'degree' => 'Degree',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Course::className(), ['idLecturer' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDepartment0()
    {
        return $this->hasOne(Department::className(), ['id' => 'idDepartment']);
    }

    public static function findByEmail($email)
    {
        $lecturer = Lecturer::find()->where(['email' => $email])->one();
        return $lecturer; 
    }

    public function checkPassword($password)
    {
        return $this->getAttribute('passHash') == md5($password);
    }

    public function validateEmail($attribute, $params)
    {
        $user = Lecturer::find()->where(['email'=>$this->email])->count() + Student::find()->where(['email'=>$this->email])->count();
        if ($user!=0)
            $this->addError('email','Данный email уже используется.');
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $lecturer = Lecturer::find()->where(['passHash' => $token])->one();
        return $lecturer; 
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
        $lecturer = Lecturer::find()->where(['id' => $id])->one();
        return $lecturer;
    }
}
