<?php

namespace app\models;

use Yii;
use app\models\Student;

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

    public $password;
    public $confirmation;


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
            [['active', 'name', 'email', 'passHash', 'idDepartment'], 'required', 'message'=>'Поле "{attribute}" не может быть пустым.'],
            [['active', 'idDepartment'], 'integer'],
            [['name', 'email', 'passHash', 'degree'], 'string', 'max' => 255],
            ['name', 'match', 'pattern'=>'/[a-zA-Zа-яёА-Я][a-zA-Zа-яёА-Я\\s-]+$/', 'message' => 'Пожалуйста, введите корректное имя'],
            ['email', 'email', 'message' => 'Пожалуйста, введите корректный email'],
            ['email', 'validateEmail'],
            ['confirmation', 'compare', 'compareAttribute'=>'password', 'message'=>"Подтверждение пароля не совпадает с паролем."]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'active' => 'Подтвержден',
            'name' => 'Имя',
            'email' => 'Email',
            'passHash' => 'Хэш пароля',
            'idDepartment' => 'Кафедра',
            'degree' => 'Степень',
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
    public function getIdDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'idDepartment']);
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'idDepartment'])->one()->name;
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

    public function updateLc()
    {
        if($this->password!='')
        {
            $this->passHash = md5($this->password);
        }
        return $this->save();
    }

    public function validateEmail($attribute, $params)
    {
        foreach (Lecturer::find()->where(['email'=>$this->email])->all() as $value) {
            if($value->id != $this->id)
            {
                $this->addError('email','Данный email уже используется.');
            }
        }

        foreach (Student::find()->where(['email'=>$this->email])->all() as $value) {
            if($value->id != $this->id)
            {
                $this->addError('email','Данный email уже используется.');
            }
        }
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $lecturer = Lecturer::find()->where(['passHash' => $token])->one();
        return $lecturer; 
    }

    public function getId()
    {
        return $this->id + 3010;
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
        $lecturer = Lecturer::find()->where(['id' => $id - 3010])->one();
        return $lecturer;
    }
}
