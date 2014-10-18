<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LessonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $courseModel app\models\Course */

$this->title = 'Уроки курса - "'.$courseModel->name.'"';
$this->params['breadcrumbs'][] = "Course {$courseModel->id} lessons";
?>
<div class="lesson-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lesson', ['create?id='.$courseModel->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            //'idCourse',   
            'name',
            'description:ntext',
            'published',
            // 'lessonNumber',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
