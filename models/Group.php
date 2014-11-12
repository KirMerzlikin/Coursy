<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Student[] $students
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            ['name', 'match', 'pattern'=>'/[a-zA-Zа-яёА-Я][a-zA-ZйцукенгшщёзхъэждлорпавыфячсмитьбюЙЦУКЕНГШЁЩЗХЪЖЭДЛОРПАВЫФЯЧСМИТЬБЮ0-9\\s-]*$/', 'message' => 'Пожалуйста, введите корректную группу'],
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
            'name' => 'Название',
        ];
    }

    public function validateName()
    {
        foreach (Group::find()->where(['name'=>$this->name])->all() as $value) {
            if($value->id != $this->id)
            {
                $this->addError('name','Данная группа уже существует.');
            }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::className(), ['idGroup' => 'id']);
    }
}
