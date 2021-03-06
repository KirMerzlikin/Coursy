<?php

namespace app\controllers;

use Yii;
use app\models\Attachment;
use app\models\AttachmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AttachmentController implements the CRUD actions for Attachment model.
 */
class AttachmentController extends Controller
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
     * Creates a new Attachment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $this->validateAccess(self::LECTURER);
        $model = new Attachment();
        $model->idLesson = $id;
        if (isset($_FILES['Attachment'])) {
            $rnd = rand(0,9999);
            $uploadedFile = UploadedFile::getInstance($model,'resource');
            $fileName = 'files/'.$rnd.'_'.$uploadedFile->name;
            $model->resource = $fileName;
            $uploadedFile->saveAs($fileName);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['lesson/edit', 'id' => $model->idLesson]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Attachment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->validateAccess(self::LECTURER);
        $model = $this->findModel($id);

        if (isset($_FILES['Attachment'])) {
            unlink(Yii::getAlias('@app').Yii::getAlias('@web').'/'.$model->resource);
            $rnd = rand(0,9999);
            $uploadedFile = UploadedFile::getInstance($model,'resource');
            $fileName = 'files/'.$rnd.'_'.$uploadedFile->name;
            $model->resource = $fileName;
            $uploadedFile->saveAs($fileName);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['lesson/view', 'id' => $model->idLesson]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Attachment model.
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

    /**
     * Finds the Attachment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Attachment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Attachment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionFileForceDownload($id) {
        $file = Attachment::findOne($id)->resource;
        if (file_exists($file)) {
            if (ob_get_level()) {
                ob_end_clean();
            }
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
        else{
            $this->layout = 'main_alternative';
            return $this->render('fail');
        }
    }
}
