<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "result".
 *
 * @property integer $idStudent
 * @property integer $idLesson
 * @property integer $points
 * @property integer $passed
 * @property integer $tryNumber
 * @property integer $approved
 *
 * @property Student $idStudent0
 * @property Lesson $idLesson0
 */
class Result extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'result';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idStudent', 'idLesson', 'tryNumber'], 'required'],
            [['idStudent', 'idLesson', 'points', 'passed', 'tryNumber', 'approved'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idStudent' => 'Id Student',
            'idLesson' => 'Id Lesson',
            'points' => 'Points',
            'passed' => 'Passed',
            'tryNumber' => 'Try Number',
            'approved' => 'Approved',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'idStudent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLesson()
    {
        return $this->hasOne(Lesson::className(), ['id' => 'idLesson']);
    }
}
