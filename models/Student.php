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
            [['name', 'email', 'passHash', 'idGroup', 'active'], 'required'],
            [['idGroup', 'active'], 'integer'],
            [['name', 'email', 'passHash'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'passHash' => 'Pass Hash',
            'idGroup' => 'Id Group',
            'active' => 'Active',
        ];
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
    public function getIdGroup0()
    {
        return $this->hasOne(Group::className(), ['id' => 'idGroup']);
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

    public function validatePassword($password)
    {
       return $this->passHash == md5($password);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        $student = Student::find()->where(['passHash' => $token])->one();
        return $student; 
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
        $student = Student::find()->where(['id' => $id])->one();
        return $student;
    }
}
