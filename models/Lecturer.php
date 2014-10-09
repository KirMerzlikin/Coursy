<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lecturer".
 *
 * @property integer $id
 * @property integer $active
 * @property string $name
 * @property string $email
 * @property string $passHash
 * @property integer $idDepartment
 * @property string $degree
 *
 * @property Course[] $courses
 * @property Department $idDepartment0
 */
class Lecturer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lecturer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active', 'name', 'email', 'passHash', 'idDepartment'], 'required'],
            [['active', 'idDepartment'], 'integer'],
            [['name', 'email', 'passHash', 'degree'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'active' => 'Active',
            'name' => 'Name',
            'email' => 'Email',
            'passHash' => 'Pass Hash',
            'idDepartment' => 'Id Department',
            'degree' => 'Degree',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Course::className(), ['idLecturer' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDepartment0()
    {
        return $this->hasOne(Department::className(), ['id' => 'idDepartment']);
    }
}
