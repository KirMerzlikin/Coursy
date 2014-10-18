<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Lesson */
/* @var $courseModel app\models\Course */
/* @var $dataProviderAttachment app\models\Attachment */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Lessons', 'url' => ['view-course?id='.$courseModel->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lesson-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'idCourse',
            [
                'label'=>'Course',
                'value'=>$courseModel->name,
            ],
            'name',
            'description:ntext',
            'published',
            'lessonNumber',
        ],
    ]) ?>
<br/>
<h3>Прикрепленные файлы к уроку</h3>
<p>
<?= Html::a('Добавить файл', ['attachment/create?id='.$model->id], ['class' => 'btn btn-success']) ?>
</p>
    <?= GridView::widget([
        'dataProvider' => $dataProviderAttachment,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'resource',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    $url ='../attachment/'.$action.'?id='.$model->id;
                    return $url;
                }
            ],
        ],
    ]); ?>

</div>
