<?php

namespace app\controllers;

use Yii;
use app\models\Result;
use app\models\Student;
use app\models\StudentAnswer;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResultController implements the CRUD actions for Result model.
 */
class ResultController extends Controller
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

    /**
     * Lists all Result models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Result model.
     * @param integer $idStudent
     * @param integer $idLesson
     * @return mixed
     */
    public function actionView($idStudent, $idLesson)
    {
        return $this->render('view', [
            'model' => $this->findModel($idStudent, $idLesson),
        ]);
    }

    /**
     * Creates a new Result model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Result();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idStudent' => $model->idStudent, 'idLesson' => $model->idLesson]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Result model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idStudent
     * @param integer $idLesson
     * @return mixed
     */
    public function actionUpdate($idStudent, $idLesson)
    {
        $model = $this->findModel($idStudent, $idLesson);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idStudent' => $model->idStudent, 'idLesson' => $model->idLesson]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Result model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idStudent
     * @param integer $idLesson
     * @return mixed
     */
    public function actionDelete($idStudent, $idLesson)
    {
        $this->findModel($idStudent, $idLesson)->delete();

        return $this->redirect(['index']);
    }

    public function actionList()
    {
        $this->layout = 'main_layout';
        $lcModel = Yii::$app->user->getIdentity();

        $results = Result::find()->where(['approved' => '0'])->all();
        $testModel = [];
        foreach($results as $result)
        {
            if($result->getIdLesson()->one()->getIdCourse()->one()->idLecturer == $lcModel->id)
            {
                $testModel[] = Student::findOne(['id' => $result->idStudent])->getStudentAnswers()->
                    innerJoin('question', 'idQuestion = id')->where('idLesson = ' . $result->idLesson)->all();
            }
        }

        return $this->render('list', [
            'lcModel' => $lcModel,
            'testModel' => $testModel]);
    }

    public function actionHandleResult()
    {
        $res = Result::findOne(['idStudent' => $_POST['idStudent'], 'idLesson' => $_POST['idLesson']]);
        $res->approved = 1;
        $res->points = $_POST['mark'];
        $res->passed = $res->points > 60 ? 1 : 0;

        $res->save();

        foreach($res->getIdLesson()->one()->getQuestions()->all() as $question)
        {
            $answers = StudentAnswer::deleteAll(['idStudent' => $_POST['idStudent'], 'idQuestion' => $question->id]);
        }
    }

    /**
     * Finds the Result model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idStudent
     * @param integer $idLesson
     * @return Result the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idStudent, $idLesson)
    {
        if (($model = Result::findOne(['idStudent' => $idStudent, 'idLesson' => $idLesson])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
