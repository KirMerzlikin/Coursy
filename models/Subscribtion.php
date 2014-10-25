<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscription".
 *
 * @property integer $id
 * @property integer $idCourse
 * @property integer $idStudent
 * @property integer $active
 *
 * @property Course $idCourse0
 * @property Student $idStudent0
 */
class Subscribtion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscription';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCourse', 'idStudent', 'active'], 'required'],
            [['idCourse', 'idStudent', 'active'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idCourse' => 'Id Course',
            'idStudent' => 'Id Student',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'idCourse']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'idStudent']);
    }
}
