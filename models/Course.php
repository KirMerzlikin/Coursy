<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "course".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $idLecturer
 * @property integer $published
 *
 * @property Lecturer $idLecturer0
 * @property Lesson[] $lessons
 * @property Subscribtion[] $subscriptions
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'idLecturer', 'published'], 'required', 'message' => 'Пожалуйста, заполните это поле'],
            [['description'], 'string'],
            [['idLecturer', 'published'], 'integer'],
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
            'name' => 'Название',
            'description' => 'Описание',
            'idLecturer' => 'Лектор',
            'published' => 'Опубликован',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLecturer()
    {
        return $this->hasOne(Lecturer::className(), ['id' => 'idLecturer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLessons()
    {
        return $this->hasMany(Lesson::className(), ['idCourse' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptions()
    {
        return $this->hasMany(Subscribtion::className(), ['idCourse' => 'id']);
    }
}
