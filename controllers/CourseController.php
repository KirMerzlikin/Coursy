<?php

namespace app\controllers;

use Yii;
use app\models\Course;
use app\models\CourseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends Controller
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
     * NOT IN USE NOW
     * Lists all Course models.
     * @return mixed
     */
    /*public function actionIndex()
    {
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/

    /**
     * NOT IN USE NOW
     * Displays a single Course model.
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
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'is_lecturer' => $user->tableName() == 'lecturer',
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
		$this->layout = "main_layout";
        $this->validateAccess(self::LECTURER | self::ADMIN);

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->user->returnUrl);
        } else {
            return $this->render('update', [
                'model' => $model,
                'is_lecturer' => Yii::$app->user->identity->tableName() == 'lecturer',
            ]);
        }
    }

    /**
     * Deletes an existing Course model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
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
    
      public function actionPresentation()
    {
         $this->layout = "main_layout"; 
       $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('presentation', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
     public function actionList()
    {
         $this->layout = "main_layout"; 
     //   $this->validateAccess(self::LECTURER);
        $model = new Course();
         return $this->render('list', [
                'model' => $model,
            ]);

     /*   if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('list', [
                'model' => $model,
            ]);
        }*/
    }
}
