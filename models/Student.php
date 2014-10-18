<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $passHash
 * @property integer $idGroup
 * @property integer $active
 *
 * @property Result[] $results
 * @property Lesson[] $idLessons
 * @property Group $idGroup0
 * @property Studentanswer[] $studentanswers
 * @property Question[] $idQuestions
 * @property Subscription[] $subscriptions
 */
class Student extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */


    public $password;
    public $confirmation;

    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'passHash', 'idGroup', 'active'], 'required', 'message'=>'Поле "{attribute}" не может быть пустым.'],
            [['idGroup', 'active'], 'integer'],
            [['name', 'email', 'passHash'], 'string', 'max' => 255],
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
            'name' => 'Имя',
            'email' => 'Email',
            'passHash' => 'Хэш пароля',
            'idGroup' => 'Группа',
            'active' => 'Подтвержден',
        ];
    }


    public function validatePassword()
    {
        if ($this->confirmation!=$this->password)
            $this->addError('confirmation','Подтверждение пароля не совпадает с паролем.');
    }

    public function updateSt()
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Result::className(), ['idStudent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLessons()
    {
        return $this->hasMany(Lesson::className(), ['id' => 'idLesson'])->viaTable('{result}', ['idStudent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'idGroup']);
    }

    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'idGroup'])->one()->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentanswers()
    {
        return $this->hasMany(Studentanswer::className(), ['idStudent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdQuestions()
    {
        return $this->hasMany(Question::className(), ['id' => 'idQuestion'])->viaTable('{studentanswer}', ['idStudent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptions()
    {
        return $this->hasMany(Subscription::className(), ['idStudent' => 'id']);
    }

    public static function findByEmail($email)
    {
        $student = Student::find()->where(['email' => $email])->one();
        return $student;
    }

    public function checkPassword($password)
    {
       return $this->passHash == md5($password);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        $student = Student::find()->where(['passHash' => $token])->where(['active' => 1])->one();
        return $student; 
    }

    public function getId()
    {
        return $this->id + 10;
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
        $student = Student::find()->where(['id' => $id - 10])->one();
        return $student;
    }
}
