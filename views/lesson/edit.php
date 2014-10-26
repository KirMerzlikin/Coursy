<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\grid\GridView;

?>
<div class="wrapper2 clearfix">
<?php echo Html::tag('div','Лекции', ['id'=>'page_name']);?>
<div style="width: 26%; float:left;">
<?=
    $this->render('..\lecturer\menu_left', ['current' => 'courses', 'model' => $lcModel]);
?>
</div>

<div style="position:relative; width: 73%; float:left;">

<div class="panel panel-default">
  <div class="panel-heading"><b>Общая информация</b></div>
  <div class="panel-body">
    <?= $this->render('_form', [
        'model' => $lsModel
    ]) ?>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading"><b>Материалы</b></div>
  <div class="panel-body">
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
                    $params = is_array($key) ? $key : ['id' => (string) $key];
                    $params[0] = '/attachment' . '/' . $action;

                    return Url::toRoute($params);
                }
            ],
        ],
    ]); ?>
  <a href="<?=Url::to(['attachment/create','id'=>$lsModel->id]);?>" class="btn btn-primary pull-right">Добавить</a>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading"><b>Тестовые задания</b></div>
  <div class="panel-body">
   <?= GridView::widget([
        'dataProvider' => $dataProviderQuestion,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'text',
            'answer',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, $lsModel, $key, $index) {
                    $params = is_array($key) ? $key : ['id' => (string) $key];
                    $params[0] = '/question' . '/' . $action;

                    return Url::toRoute($params);
                }
            ],
        ],
    ]); ?>
  <a href="<?=Url::to(['question/create','id'=>$lsModel->id]);?>" class="btn btn-primary pull-right">Добавить</a>
  </div>
</div>

</div>
</div>