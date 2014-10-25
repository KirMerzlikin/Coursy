<?php 
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;
Yii::$app->user->returnUrl = Yii::$app->request->getAbsoluteUrl();
?><div class="wrapper2 clearfix">
<?php echo Html::tag('div','Информация о курсе', ['id'=>'page_name']);?>

<div style="position:relative; width: 73%; float:left;">
<?php echo Html::tag('div', Html::tag('center', Html::tag('h1', $model->name)));
?>
    <div class="form-group">

        <?= Html::tag('div', Html::tag('center', Html::tag('h6','Лекции:'. $model->getLessons()->count().'.')))?>
        <?=Html::img('h', ['style'=>'width: 150px; height: 150px; float:left; margin: 7px 7px 7px 0;'])?>
         
        <?= Html::tag('div', $model->description)?>
        <?= Html::tag('div',Html::tag('h4','Автор: '.$model->getIdLecturer()->one()->name))?>
        
         <?= Html::tag('div',Html::tag('center',Html::tag('h3','План занятий')))?>
      
      <?php
		for($i = 0; $i < $model->getLessons()->count(); $i++)
		{
			echo Html::beginTag('div', ['class' => 'panel panel-default']);
			echo Html::tag('div', Html::tag('span', $model->getLessons()->all()[$i]->getCourse()->one()->name, ['class' => 'panel-title', 'style' => 'float:left; width:80%;']));
			echo Html::beginTag('div', ['class' => 'panel-body']);
			echo Html::tag('div', $model->getLessons()->all()[$i]->description);
			echo Html::endTag('div'); 
			echo Html::endTag('div'); 
		}
	  
	  ?>
      <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
         //   ['class' => 'yii\grid\SerialColumn'],

            'idCourse'=>'Занятия',
         
            'name'=> 'Заголовок',
            'description'=>'Описание',
        

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
