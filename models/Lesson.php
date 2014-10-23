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
            [['name'], 'string', 'max' => 255]
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
            'name' => 'Название',
            'description' => 'Описание',
            'published' => 'Опубликован',
            'lessonNumber' => 'Порядковый номер',
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
