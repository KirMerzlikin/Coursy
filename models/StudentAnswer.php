<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "studentanswer".
 *
 * @property integer $idQuestion
 * @property integer $idStudent
 * @property string $answer
 *
 * @property Question $idQuestion
 * @property Student $idStudent
 */
class StudentAnswer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'studentanswer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idQuestion', 'idStudent'], 'required'],
            [['idQuestion', 'idStudent'], 'integer'],
            [['answer'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idQuestion' => 'Id Question',
            'idStudent' => 'Id Student',
            'answer' => 'Answer',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'idQuestion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'idStudent']);
    }
}
