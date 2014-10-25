<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property integer $idLesson
 * @property string $text
 * @property string $answer
 *
 * @property Lesson $idLesson0
 * @property Studentanswer[] $studentanswers
 * @property Student[] $idStudents
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idLesson', 'text', 'answer'], 'required'],
            [['idLesson'], 'integer'],
            [['text', 'answer'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idLesson' => 'Id Lesson',
            'text' => 'Text',
            'answer' => 'Answer',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLesson()
    {
        return $this->hasOne(Lesson::className(), ['id' => 'idLesson']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentAnswers()
    {
        return $this->hasMany(StudentAnswer::className(), ['idQuestion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStudents()
    {
        return $this->hasMany(Student::className(), ['id' => 'idStudent'])->viaTable('{studentanswer}', ['idQuestion' => 'id']);
    }
}
