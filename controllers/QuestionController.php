<?php

namespace app\controllers;

use Yii;
use app\models\Question;
use app\models\QuestionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Lesson;
use app\models\StudentAnswer;
use app\models\Result;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends Controller
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
     * Lists all Question models.
     * @return mixed
     */
    /*
    public function actionIndex()
    {
        $this->validateAccess(self::LECTURER);
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    */
    /**
     * Displays a single Question model.
     * @param integer $id
     * @return mixed
     */
    /*
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    */
    public function actionList($id)
    {
        $this->validateAccess(self::LECTURER);
        $this->layout = 'main_layout';
        $stModel = Yii::$app->user->identity; 
        $lesson = Lesson::findOne($id);
        $qListModel = $lesson->getQuestions();

         return $this->render('list', [
                'stModel' => $stModel,
                'qListModel' => $qListModel,
                ]);
    }

    /**
     * Creates a new Question model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $this->validateAccess(self::LECTURER);
        $model = new Question();
        $model->idLesson = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['lesson/edit', 'id' => $id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Question model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->validateAccess(self::LECTURER);
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['lesson/edit', 'id' => $model->idLesson]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Question model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->validateAccess(self::LECTURER);
        $model = $this->findModel($id);
        $idLesson = $model->idLesson;
        $model->delete();

        return $this->redirect(['lesson/edit','id' => $idLesson]);
    }

    public function actionHandleCompletion()
    {
        $idStudent = $_POST['idStudent'];
        $answers = $_POST['answers'];
        $idLesson = $this->findModel(array_keys($answers)[0])->getIdLesson()->one()->id;

        foreach($answers as $idQuestion => $answer)
        {
            $stAnswer = new StudentAnswer();
            $stAnswer->load(['StudentAnswer' => ['idQuestion' => $idQuestion , 'idStudent' => $idStudent , 'answer' => $answer]]);
            $stAnswer->save();
        }

        $lastResult = Result::findOne(['idLesson' => $idLesson, 'idStudent' => $idStudent]);
        if($lastResult == null)
        {
            $lastResult = new Result();
            $lastResult->idStudent = $idStudent; 
            $lastResult->idLesson = $idLesson;
        }

        $lastResult->tryNumber = isset($lastResult->tryNumber) ? $lastResult->tryNumber + 1 : 1;
        $lastResult->approved = 0;

        $lastResult->save();
    }

    /**
     * Finds the Question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Question the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
