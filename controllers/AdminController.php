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
use app\models\AdminSearch;
use app\models\CourseSearch;
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

     public function validateAccess()
    {
        if(Yii::$app->user->isGuest)
        {
            return $this->redirect('../site/login');
        }
        else if (Yii::$app->user->identity->tableName() != 'admin')
        {
            return $this->redirect('../web/site/about');
        }

    }

    public function actionRequests()
    {
        $this->validateAccess();
        $stSearchModel = new StudentSearch();
        $lcSearchModel = new LecturerSearch();

        return $this->render('requests', [
            'stSearchModel' => $stSearchModel,
            'lcSearchModel' => $lcSearchModel,
        ]);
    }

    public function actionDatabase()
    {
        $this->validateAccess();

        $stSearchModel = new StudentSearch();
        $stDataProvider = $stSearchModel->search(['StudentSearch' => ['active' => '1']]);
        $stDataProvider->setPagination(['pageSize' => 10]);

        $lcSearchModel = new LecturerSearch();
        $lcDataProvider = $lcSearchModel->search(['LecturerSearch' => ['active' => '1']]);
        $lcDataProvider->setPagination(['pageSize' => 10]);

        $grSearchModel = new GroupSearch();
        $grDataProvider = $grSearchModel->search([]);
        $grDataProvider->setPagination(['pageSize' => 10]);

        $depSearchModel = new DepartmentSearch();
        $depDataProvider = $depSearchModel->search([]);
        $depDataProvider->setPagination(['pageSize' => 10]);

        $crSearchModel = new CourseSearch();
        $crDataProvider = $crSearchModel->search([]);
        $crDataProvider->setPagination(['pageSize' => 10]);

         return $this->render('database', [
            'stSearchModel' => $stSearchModel,
            'stDataProvider' => $stDataProvider,
            'lcSearchModel' => $lcSearchModel,
            'lcDataProvider' => $lcDataProvider,
            'grSearchModel' => $grSearchModel,
            'grDataProvider' => $grDataProvider,
            'depSearchModel' => $depSearchModel,
            'depDataProvider' => $depDataProvider,
            'crSearchModel' => $crSearchModel,
            'crDataProvider' => $crDataProvider,
        ]);


    }

    public function actionIndex()
    {
        return $this->actionDatabase();
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
        else
        {
            $user = User::findByEmail($email);
            $user->delete();
        }
    }

    private function sendMail($email, $result, $reason)
    {
        $subject = ($result ? "Подтверждение" : "Отклонение") . " регистрации. Coursey.it-team.in.ua";
        $body = "Ваша заявка на регистрацию на сайте Coursey была "
            . ($result ? "подтверждена" : "отклонена.\nПричина: " . $reason) . ". Не отвечайте на это письмо.";
        Yii::$app->mailer->compose()
                ->setFrom('noreply@coursey.it-team.in.ua')
                ->setTo($email)
                ->setSubject($subject)
                ->setTextBody($body)
                ->send();
    }


}
