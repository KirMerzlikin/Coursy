<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;


?>

<div class="wrapper2 clearfix">
<?php echo Html::tag('div','Лекция', ['id'=>'page_name']);?>
<div style="width: 26%; float:left;">
<?=
    $this->render('../lecturer/menu_left', ['current' => 'courses', 'model' => $lcModel]);
?>
</div>

<div style="position:relative; width: 73%; float:left;">
<div class="panel panel-default">
<div class="panel-body" style='padding-top:10px;'>
<div class="lesson-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['edit', 'id' => $lsModel->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $lsModel->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $lsModel,
        'attributes' => [
            //'id',
            //'idCourse',
            [
                'label'=>'Курс',
                'value'=>$lsModel->getIdCourse()->one()->name,
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
<?= Html::a('Добавить файл', ['attachment/create?id='.$lsModel->id], ['class' => 'btn btn-success']) ?>
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
                'urlCreator' => function ($action, $lsModel, $key, $index) {
                    $url ='../attachment/'.$action.'?id='.$lsModel->id;
                    return $url;
                }
            ],
        ],
    ]); ?>
<br/>
<h3>Вопросы к уроку</h3>
<p>
<?= Html::a('Добавить вопрос', ['question/create?id='.$lsModel->id], ['class' => 'btn btn-success']) ?>
</p>
    <?= GridView::widget([
        'dataProvider' => $dataProviderQuestion,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'text',
            'answer',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, $lsModel, $key, $index) {
                    $url ='../attachment/'.$action.'?id='.$key;
                    return $url;
                }
            ],
        ],
    ]); ?>

</div>
</div>
</div>
</div>
</div>
