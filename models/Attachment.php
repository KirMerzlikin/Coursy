<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attachment".
 *
 * @property integer $id
 * @property string $name
 * @property string $resource
 * @property integer $idLesson
 *
 * @property Lesson $idLesson0
 */
class Attachment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attachment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idLesson'], 'required'],
            [['idLesson'], 'integer'],
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
            'name' => 'Name',
            'resource' => 'Resource',
            'idLesson' => 'Id Lesson',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLesson0()
    {
        return $this->hasOne(Lesson::className(), ['id' => 'idLesson']);
    }
}
