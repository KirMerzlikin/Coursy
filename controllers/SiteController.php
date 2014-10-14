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
        $this->layout='new';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(Yii::$app->user->identity->tableName() == 'admin')
                return $this->redirect('../admin');
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
        $this->layout = "new";
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new RegistrationForm();
        if(array_key_exists('Registration', $_POST))
        {
            $info = $_POST['RegistrationForm'];
            $model->department = $info['department'];
            $model->degree = $info['degree'];
            $model->group = $info['group'];
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //$model->group = $_POST['RegistrationForm[group]'];
            if($model->register())
                return $this->render('success_registration');
            else
                return $this->render('fail_registration');
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

    public function actionRecovery()
    {
        $this->layout='new';
        //if (!\Yii::$app->user->isGuest) {
        //    return $this->goHome();
        //}
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())){
            if($model->recovery())
            {
                return $this->render('success_recovery');
            }
            else{
                return $this->render('fail_recovery');
            }
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
}
