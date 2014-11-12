<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lesson".
 *
 * @property integer $id
 * @property integer $idCourse
 * @property string $name
 * @property string $description
 * @property integer $published
 * @property integer $lessonNumber
 *
 * @property Attachment[] $attachments
 * @property Course $idCourse0
 * @property Question[] $questions
 * @property Result[] $results
 * @property Student[] $idStudents
 */
class Lesson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lesson';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCourse', 'name', 'description', 'published', 'lessonNumber'], 'required',  'message' => 'Пожалуйста, заполните это поле'],
            [['idCourse', 'published', 'lessonNumber'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            ['lessonNumber', function ($attribute, $params)
                {
                    if(Lesson::find()->where(['idCourse' => $this->idCourse, 'lessonNumber' => $this->lessonNumber, 
                        ['not', ['id' => $this->id]]])->count() != 0)
                        $this->addError($attribute, 'У лекций не может быть одинаковых порядковых номеров');
                }],
            ['lessonNumber', function ($attribute, $params)
                {
                    if($this->lessonNumber < 0)
                        $this->addError($attribute, 'Номер лекции должен быть неотрицательным числом');
                }]
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
            'name' => 'Название лекции',
            'description' => 'Описание лекции',
            'published' => 'Опубликована',
            'lessonNumber' => 'Порядковый номер лекции',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttachments()
    {
        return $this->hasMany(Attachment::className(), ['idLesson' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'idCourse']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['idLesson' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Result::className(), ['idLesson' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStudents()
    {
        return $this->hasMany(Student::className(), ['id' => 'idStudent'])->viaTable('{result}', ['idLesson' => 'id']);
    }
}
