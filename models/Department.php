<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Lecturer[] $lecturers
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            ['name', 'match', 'pattern'=>'/[a-zA-Zа-яёА-Я][a-zA-Zа-яёА-Я\\s-]*$/', 'message' => 'Пожалуйста, введите корректную кафедру'],
            ['name', 'validateName']
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
        ];
    }

    public function validateName()
    {
        $group = Department::find()->where(['name'=>$this->name])->count();
        if($group != 0)
        {
            $this->addError('name','Данная кафедра уже существует.');
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLecturers()
    {
        return $this->hasMany(Lecturer::className(), ['idDepartment' => 'id']);
    }
}
