<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Admin;
use app\models\StudentSearch;
use app\models\LecturerSearch;
use app\models\DepartmentSearch;
use app\models\GroupSearch;
use app\models\User;

class AdminController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    
    public function actionStudent()
    {
        $this->layout = "new";
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $lcSearchModel = new LecturerSearch();

        return $this->render('student', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'stSearchModel' => $searchModel,
            'lcSearchModel' => $lcSearchModel,
        ]);
    }

    public function actionLecturer()
    {
        $this->layout = "new";
        $searchModel = new LecturerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $stSearchModel = new StudentSearch();

        return $this->render('lecturer', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'stSearchModel' => $stSearchModel,
            'lcSearchModel' => $searchModel,
        ]);
    }

    public function actionDepartment()
    {
        $this->layout = "new";
        $searchModel = new DepartmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $stSearchModel = new StudentSearch();
        $lcSearchModel = new LecturerSearch();

        return $this->render('department', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'stSearchModel' => $stSearchModel,
            'lcSearchModel' => $lcSearchModel,
        ]);
    }

    public function actionGroup()
    {
        $this->layout = "new";
        $searchModel = new GroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $stSearchModel = new StudentSearch();
        $lcSearchModel = new LecturerSearch();

        return $this->render('group', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'stSearchModel' => $stSearchModel,
            'lcSearchModel' => $lcSearchModel,
        ]);
    }

    public function actionContact()
    {
        $this->layout = "new";
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionHandleResponse()
    {
        $email = $_POST['email'];
        $response = $_POST['response'];
        $reason = $_POST['reason'];

        $this->sendMail($email, $response == 'true' ? true : false, $reason);

        if($response == 'true')
        {
            $user = User::findByEmail($email);
            $user->active = 1;
            $user->save();
        }
    }

    private function sendMail($email, $result, $reason)
    {
        $subject = imap_utf8($result ? "Подтверждение" : "Отклонение") . "регистрации.";
        $body = "Ваша заявка на регистрацию на сайте Coursey была " 
            . ($result ? "подтверждена" : "отклонена. \nПричина:" . $reason) . ". Don't reply.";
        Yii::$app->mailer->compose()
                ->setTo($email)
                ->setSubject($subject)
                ->setTextBody($body)
                ->send();        
    }

    
}
