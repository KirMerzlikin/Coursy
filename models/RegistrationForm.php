<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Lecturer;
use app\models\Student;

/**
 * LoginForm is the model behind the login form.
 */
class RegistrationForm extends Model
{
    public $name;
    public $second_name;
    public $email;
    public $password;
    public $confirmation;
    public $role;
    public $department;
    public $degree;
    public $group;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['name','second_name','email', 'password','confirmation','role'], 'required', 'message' => 'Пожалуйста, заполните это поле'],
            ['email', 'email', 'message' => 'Пожалуйста, введите корректный email'],
            // password is validated by validatePassword()
            ['name', 'match', 'pattern'=>'/^[a-zA-ZйцукенгшщёзхъэждлорпавыфячсмитьбюЙЦУКЕНГШЁЩЗХЪЖЭДЛОРПАВЫФЯЧСМИТЬБЮ-]+$/', 'message' => 'Пожалуйста, введите корректное имя.'],
            ['second_name', 'match', 'pattern'=>'/^[a-zA-ZйцукенгшщёзхъэждлорпавыфячсмитьбюЙЦУКЕНГШЁЩЗХЪЖЭДЛОРПАВЫФЯЧСМИТЬБЮ-]+$/', 'message' => 'Пожалуйста, введите корректную фамилию.'],
            ['password', 'validatePassword'],
            ['email', 'validateEmail'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Ваше имя',
            'second_name' => 'Ваша фамилия',
            'email' => 'Ваш Email',
            'password' => 'Пароль',
            'confirmation' => 'Повторите пароль',
            'role' => 'Кем Вы хотите быть?',
            'degree' => 'Ученая степень',
            'department' => 'Кафедра',
            'group' => 'Группа',
        ];
    }

    /**
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */

    public function validatePassword($attribute, $params)
    {
        if ($this->confirmation!=$this->password)
            $this->addError('confirmation','Подтверждение пароля не совпадает с паролем.');
    }

   

    public function validateEmail($attribute, $params)
    {
        $user = Lecturer::find()->where(['email'=>$this->email])->count() + Student::find()->where(['email'=>$this->email])->count();

        if ($user!=0)
            $this->addError('email','Данный email уже используется.');
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function register()
    {
        if ($this->role == 'lecturer')
        {
            $lecturer = new Lecturer();
            $lecturer->name = $this->name." ".$this->second_name;
            $lecturer->email = $this->email;
            $lecturer->passHash = md5($this->password);
            //$info = $_POST['RegistrationForm'];
            $lecturer->idDepartment = $this->department;//$info['department'];
            $lecturer->degree = $this->degree;//$info['degree'];
            $lecturer->active = 0;
            return $lecturer->save();
        }
        else if ($this->role == 'student')
        {
            $student = new Student();
            $student->name = $this->second_name." ".$this->name;
            $student->email = $this->email;
            $student->passHash = md5($this->password);
            //$info = $_POST['RegistrationForm'];
            $student->idGroup = $this->group;//$info['group'];
            $student->active = 0;
            return $student->save();
        }
        else
            return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->email);
        }

        return $this->_user;
    }
}
