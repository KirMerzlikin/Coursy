<?php

namespace app\controllers;

use Yii;
use app\models\Course;
use app\models\Subscription;
use app\models\CourseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends Controller
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
     * NOT IN USE NOW
     * Displays a single Course model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = "main_layout";
        return $this->render('view', [
            'crModel' => $this->findModel($id),
            'lcModel' => $this->findModel($id)->getIdLecturer()->one(),
        ]);
    }

    /**
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = "main_layout";
		$this->validateAccess(self::LECTURER);
        $user = Yii::$app->user->identity;
        $model = new Course();
        $model->idLecturer =  $user->id;

        if (isset($_FILES['Course'])) {
            $rnd = rand(0,9999);
            $uploadedFile = UploadedFile::getInstance($model,'image');
            $fileName = 'files/'.$rnd.'_'.$uploadedFile->name;
            $model->image = $fileName;
            $uploadedFile->saveAs($fileName);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['lecturer/courses']);
        } else {
            return $this->render('create', [
                'crModel' => $model,
                'lcModel' => Yii::$app->user->identity,
                'is_lecturer' => true,
            ]);
        }
    }

    /**
     * Updates an existing Course model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		$this->validateAccess(self::ADMIN);
        $model = $this->findModel($id);

        if (isset($_FILES['Course'])) {
            if ($model->image != "")
                unlink(Yii::getAlias('@app').Yii::getAlias('@web').'/'.$model->image);
            $rnd = rand(0,9999);
            $uploadedFile = UploadedFile::getInstance($model,'image');
            $fileName = 'files/'.$rnd.'_'.$uploadedFile->name;
            $model->image = $fileName;
            $uploadedFile->saveAs($fileName);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->user->returnUrl);
        } else {

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionEdit($id)
    {
        $this->layout = "main_layout";
        $this->validateAccess(self::LECTURER);
        $model = $this->findModel($id);

        if (isset($_FILES['Course'])) {
            if ($model->image != "")
                unlink(Yii::getAlias('@app').Yii::getAlias('@web').'/'.$model->image);
            $rnd = rand(0,9999);
            $uploadedFile = UploadedFile::getInstance($model,'image');
            $fileName = 'files/'.$rnd.'_'.$uploadedFile->name;
            $model->image = $fileName;
            $uploadedFile->saveAs($fileName);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->user->returnUrl);
        } else {

            return $this->render('edit', [
                'crModel' => $model,
                'lcModel' => $this->findModel($id)->getIdLecturer()->one(),
            ]);
        }
    }

    /**
     * Deletes an existing Course model.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $course = $this->findModel($id);
        if($course->published != true)
            $course->delete();
        else
            throw new HttpException(406, 'Published course can not be deleted.');
    }

    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Course::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionViewCourse($id)
    {
        $this->layout='main_layout';
        $this->validateAccess(self::STUDENT);
        $model = Course::find()->where(['id' => $id])->one();
        $subscription = Yii::$app->user->identity->getSubscriptions()->where(['idCourse' => $id])->one();
        if($model == null)
        {
            return $this->render('fail');
        }
        else if($subscription == null||$subscription->active == 0)
        {
            return $this->render('course', ['model' => $model, 'stModel' => Yii::$app->user->identity, 'subscribed' => 0, 'current' => 'all']);
        }
        else{
            return $this->render('course', ['model' => $model, 'stModel' => Yii::$app->user->identity, 'subscribed' => 1, 'current' => 'subscriptions']);
        }
    }

    //for Student
    public function actionAll()
    {
        $this->layout='main_layout';
        $this->validateAccess(self::STUDENT);
        $courses = Course::find()->orderBy('name');
        if($courses == null)
        {
            return $this->render('fail');
        }
        else
        {
            return $this->render('all', ['courses' => $courses, 'stModel' => Yii::$app->user->identity]);
        }
    }

    public function actionSubscribe($id)
    {
        $this->validateAccess(self::STUDENT);
        $subscription = new Subscription();
        $subscription->idCourse = $id;
        $subscription->idStudent = Yii::$app->user->identity->id;
        $subscription->active = 0;
        $subscription->save();
        return $this->redirect(Yii::$app->user->returnUrl);
    }

    public function actionUnsubscribe()
    {
        $this->validateAccess(self::STUDENT);
        $subscription = Subscription::find()->where(['id' => $_POST["id"]])->one();
        list($controller) = Yii::$app->createController('student');
        $controller->actionSendMail($subscription->getCourse()->one()->getIdLecturer()->one()->email, "Отписка от курса \"".$subscription->getCourse()->one()->name."\".");
        $subscription->delete();
        return $this->redirect(Yii::$app->user->returnUrl);
    }

    public function actionSearch($key)
    {
        $this->layout='main_layout';
        $this->validateAccess(self::STUDENT);
        $courses = Course::find()->where(['like', 'name', $key])->orderBy('name');
        if($courses == null)
        {
            return $this->render('fail');
        }
        else
        {
            return $this->render('all', ['courses' => $courses, 'stModel' => Yii::$app->user->identity]);
        }
    }
}
