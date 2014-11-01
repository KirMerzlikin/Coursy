<?php

namespace app\controllers;

use Yii;
use app\models\Lecturer;
use app\models\LecturerSearch;
use app\models\SubscriptionSearch;
use app\models\Subscription;
use app\models\Course;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\StudentAnswer;

/**
 * LecturerController implements the CRUD actions for Lecturer model.
 */
class LecturerController extends Controller
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
     * Lists all Lecturer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LecturerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lecturer model.
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
     * Creates a new Lecturer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Lecturer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Lecturer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
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

    public function actionUpdateLc()
    {
        $model = Yii::$app->user->getIdentity();

        if ($model->load(Yii::$app->request->post())) {
            $info = $_POST['Lecturer'];
            $model->password = $info['password'];
            $model->confirmation = $info['confirmation'];
            if($model->updateLc())
            {
                return $this->redirect(Yii::$app->user->returnUrl);
            } else{

            }
        }
        else
        {
             return $this->render('update_lc', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Lecturer model.
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
     * Finds the Lecturer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lecturer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lecturer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

	public function actionProfile()
    {
        $this->layout = "main_layout";
        $model = Yii::$app->user->getIdentity();

        return $this->render('courses', [
                'model' => $model
        ]);
    }

    public function actionCourses()
    {
        $this->layout='main_layout';
        $model = Yii::$app->user->getIdentity();

        return $this->render('courses', [
                'model' => $model
        ]);
    }

    public function actionRequests()
    {
        $this->layout='main_layout';
        $this->validateAccess(self::LECTURER);
        $model = Yii::$app->user->getIdentity();
        $courses = $model->getCourses()->all();
        $ids = array();
        for($i = 0; $i < count($courses); $i++)
        {
            $ids[$i] = $courses[$i]->id; 
        }
        $rqSearchModel = Subscription::find();
        $rqProvider =  $rqSearchModel->where(['active' => '0']);
        if (count($rqProvider) != 0) {
            $rqProvider = $rqProvider->andWhere(['in', 'idCourse', $ids])->all();
        }
        Yii::info("Количество подписок ".count($rqProvider));
        return $this->render('requests', [
                'model' => $model,
                'rqProvider' => $rqProvider
        ]);
    }

    public function actionProfileUpdate()
    {
        $this->layout = "main_layout";
        $model = Yii::$app->user->getIdentity();

        if ($model->load(Yii::$app->request->post())) {
            $info = $_POST['Lecturer'];
            $model->password = $info['password'];
            $model->confirmation = $info['confirmation'];
            if($model->updateLc())
            {
                return $this->redirect(Yii::$app->user->returnUrl);
            } else{

            }
        }
        else
        {
             return $this->render('profile_update', [
                'model' => $model
        ]);
        }
    }

    public function actionStatistics()
    {
        $this->layout = "main_layout";
        $user = Yii::$app->user->getIdentity();

        return $this->render('statistics', [
            'model' => $user,
        ]);
    }

    public function actionHandleResponse()
    {

        $this->validateAccess(self::LECTURER);
        $email = $_POST['email'];
        $response = $_POST['response'];
        $reason = $_POST['reason'];
        $id = $_POST['id'];

        $this->sendMail($id, $email, $response == 'true' ? true : false, $reason);

        if($response == 'true')
        {
            $subscription = Subscription::find()->where(['id' => $id])->one();
            $subscription->active = 1;
            $subscription->save();
        }
        else
        {
            $subscription = Subscription::find()->where(['id' => $id])->one();
            $subscription->delete();
        }
    }

    private function sendMail($idSubscription, $email, $result, $reason)
    {
        $subject = ($result ? "Подтверждение" : "Отклонение") . " подписки на  курс ".Subscription::find()->where(['id' => $idSubscription])->one()->getCourse()->one()->name.". Coursey.it-team.in.ua";
        $body = "Ваша заявка на подписку курса на сайте Coursey была "
            . ($result ? "подтверждена" : "отклонена.\nПричина: " . $reason) . ". Не отвечайте на это письмо.";
        Yii::$app->mailer->compose()
                ->setFrom('noreply@coursey.it-team.in.ua')
                ->setTo($email)
                ->setSubject($subject)
                ->setTextBody($body)
                ->send();
    }
}
