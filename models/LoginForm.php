<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Student;
use app\models\Lecturer;
use yii\db\ActiveQuery;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $email;
    public $password;

    private $_user = null;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required', 'message' => 'Пожалуйста, заполните это поле'],
            ['email', 'email', 'message' => 'Пожалуйста, введите корректный email'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Пароль'
        ];
    }



    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неправильный email или пароль');
                $this->addError('email');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), 0);
        } else {
            return false;
        }
    }

    //to-do set from mail
    public function recovery()
    {
        $user = $this->getUser();
        if($user != null)
        {
            $newPass = $this->generatePassword();
            $user->passHash = md5($newPass);
            $subject = "New password for service Coursey.it-team.in.ua.";
            $body = "There was request for new  password  for your account. Here it is: $newPass.\n This is automatic made letter. Don't replay.";
            if(Yii::$app->mailer->compose()
                    ->setTo($this->email)
                    ->setSubject($subject)
                    ->setTextBody($body)
                    ->send())
            {
                $user->save();
                return true;
            }
        }
        return false;
    }

    private function generatePassword()
    {
        $length = 8;
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        return substr( str_shuffle( $chars ), 0, $length );
    }


    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        $user = User::findByEmail($this->email);
        return $user;
    }
}
