<?php

namespace app\controllers;

use Yii;
use app\models\Lesson;
use app\models\LessonSearch;
use app\models\Attachment;
use app\models\AttachmentSearch;
use app\models\Course;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LessonController implements the CRUD actions for Lesson model.
 */
class LessonController extends Controller
{
    const LECTURER = 1;
    const ADMIN = 2;

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
                    ($cur_user->tableName() == 'admin' && (($params & self::ADMIN) == 0)))
            return $this->redirect('../site/about');
    }

    /**
     * Lists all Lesson models.
     * @return mixed
     */
    /*  NOT IN USE
    public function actionIndex()
    {
        $searchModel = new LessonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    */

    /**
     * Displays Lessons of the course.
     * @param integer $id (idCourse)
     * @return mixed
     */

    public function actionViewCourse($id)
    {
        $course = Course::findOne($id);
        if ($course == null)
            throw new NotFoundHttpException('The requested page does not exist.');
        $searchModel = new LessonSearch();
        $dataProvider = $searchModel->search(['LessonSearch' => ['idCourse' => $id]]);

        return $this->render('course', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'courseModel' => $course,
        ]);
    }

    /**
     * Displays a single Lesson model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModelAttachment = new AttachmentSearch();
        $dataProviderAttachment = $searchModelAttachment->search(['AttachmentSearch' => ['idLesson' => $id]]);
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'courseModel' => Course::findOne($model->idCourse),
            'dataProviderAttachment' => $dataProviderAttachment,
        ]);
    }

    /**
     * Creates a new Lesson model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $id (idCourse)
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Lesson();
        $model->idCourse = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

 
	
    public function actionCr_lesson()
    {
        $model = new Lesson();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('cr_lesson', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing Lesson model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionList()
    {
        $model = new Lesson();
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('list', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Lesson model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $idCourse = $model->idCourse;
        $model->delete();

        return $this->redirect(['view-course?id='.$idCourse]);
    }

    /**
     * Finds the Lesson model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lesson the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lesson::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
