<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\registrationForm;
use app\models\ContactForm;
use app\models\StudentSearch;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $this->layout='main_layout';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(Yii::$app->user->identity->tableName() == 'admin')
                return $this->redirect('../admin');
            if(Yii::$app->user->identity->tableName() == 'student')
                return $this->redirect('../student/profile');
            if(Yii::$app->user->identity->tableName() == 'lecturer')
                return $this->redirect('../lecturer/profile');
            else return $this->redirect('../site/about');
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRegistration()
    {
        $this->layout = "main_layout";
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new RegistrationForm();
        if(array_key_exists('RegistrationForm', $_POST))
        {
            $info = $_POST['RegistrationForm'];
            if ($info['role']=='lecturer')
            {
                $model->department = $info['department'];
                $model->degree = $info['degree'];
            }
            else
                $model->group = $info['group'];
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->register())
                return $this->render('success_registration');
            else
            {
                return $this->render('fail_registration');
            }
        } else {
            return $this->render('registration', ['model'=>$model,]);
        }
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
             return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionFailRecovery()
    {
        $this->layout='main_layout';
        return $this->render('fail_recovery');
    }

    public function actionSuccessRecovery()
    {
        $this->layout='main_layout';
        return $this->render('success_recovery');
    }

    public function actionRecovery()
    {
        $this->layout='main_layout';
        //if (!\Yii::$app->user->isGuest) {
        //    return $this->goHome();
        //}
        $model = new LoginForm();
        $email = $_POST['email'];
        if($model->recovery($email)){
            return $this->redirect('success-recovery');
        }
        else{
            return $this->redirect('fail-recovery');
        }
    }
}
