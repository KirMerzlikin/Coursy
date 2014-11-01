<?php

namespace app\controllers;

use Yii;
use app\models\Student;
use app\models\StudentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
{
    const LECTURER = 1;
    const ADMIN = 2;
    const STUDENT = 3;

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

    private function validateAccess($params)
    {
        $cur_user = Yii::$app->user->identity;
        if(Yii::$app->user->isGuest)
            return $this->redirect('../site/login');
        else if(($cur_user->tableName() == 'lecturer' && (($params & self::LECTURER) == 0)) ||
                    ($cur_user->tableName() == 'admin' && (($params & self::ADMIN) == 0))||
                    ($cur_user->tableName() == 'student' && (($params & self::STUDENT) == 0)))
            return $this->redirect('../site/about');
    }

    /**
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Student model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionProfile()
    {
        $this->validateAccess(self::STUDENT);
        $this->layout='main_layout';
        $model = Yii::$app->user->getIdentity();
        return $this->render('subscriptions', [
                'model' => $model
        ]);
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionSubscriptions()
    {
        $this->validateAccess(self::STUDENT);
        $this->layout='main_layout';
        $model = Yii::$app->user->getIdentity();
        return $this->render('subscriptions', [
                'model' => $model
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->user->returnUrl);
        } else {

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionProfileUpdate()
    {
        $this->validateAccess(self::STUDENT);
        $this->layout = "main_layout";
        $model = Yii::$app->user->getIdentity();

        if ($model->load(Yii::$app->request->post())) {
            $info = $_POST['Student'];
            $model->password = $info['password'];
            $model->confirmation = $info['confirmation'];

            if($model->updateSt())
            {
                return $this->redirect(Yii::$app->user->returnUrl);
            } else{

            }
        }
        else{
             return $this->render('profile_update', [
                'model' => $model
            ]);
        }
    }

    /**
     * Deletes an existing Student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->user->returnUrl);
    }

    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSendLetter()
    {
        $this->layout='main_layout';
        $this->validateAccess(self::STUDENT);

        $email = $_POST['email'];
        $subject = 'Письмо от студента coursey.it-team.ua '.Yii::$app->user->getIdentity()->name;
        $body = $_POST['text'];

        Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->user->getIdentity()->email)
                ->setTo($email)
                ->setSubject($subject)
                ->setTextBody($body)
                ->send();
    }
}

