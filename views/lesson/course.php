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

    <p>
        <?= Html::a('Create Lesson', ['create?id='.$courseModel->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'description:ntext',
            'published',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
