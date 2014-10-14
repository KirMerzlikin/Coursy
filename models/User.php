<?php

namespace app\models;

use Yii;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = Admin::findIdentity($id);
        if(!$user)
            $user = Student::findIdentity($id);
        if (!$user)
            $user = Lecturer::findIdentity($id);

        return $user;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = Admin::findIdentityByAccessToken($token, $type = null);
        if(!$user)
            $user = Student::findIdentityByAccessToken($token, $type = null);
        if (!$user)
            $user = Lecturer::findIdentityByAccessToken($token, $type = null);

        return $user;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByEmail($email)
    {
        $user = Admin::findByEmail($email);
        if(!$user)
            $user = Student::findByEmail($email);
        if(!$user)
            $user = Lecturer::findByEmail($email);


        return $user;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->email;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->email == $authKey;
    }
}
