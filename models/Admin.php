<?php

namespace app\models;

class Admin extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $email;
    public $passHash;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'email' => 'admin@admin.com',
            'passHash' => '123456',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ]
    ];

    /**
     * @inheritdoc
     */
    public static function findIdentity($email)
    {
        return isset(self::$users[$email]) ? new static(self::$users[$email]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by email
     *
     * @param  string      $email
     * @return static|null
     */
    public static function findByUsername($email)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['email'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates passHash
     *
     * @param  string  $passHash password to validate
     * @return boolean if passHash provided is valid for current user
     */
    public function validatePassword($passHash)
    {
        return $this->passHash === $passHash;
    }
}
