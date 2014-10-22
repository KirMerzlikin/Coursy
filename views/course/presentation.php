<?php 
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;
Yii::$app->user->returnUrl = Yii::$app->request->getAbsoluteUrl();
?><div class="wrapper2">
<?php echo Html::tag('div','Информация о курсе', ['id'=>'page_name']);?>
<div style=" width:100%; height:1px; clear:both;">
<div style="width: 24%; float:left;">
 <?php echo Nav::widget([
    'items' => [
        '<li><center><b>'.$model->name.'</b></center></li>',
        '<li class="divider"></li>',
        '<li><center>item1</center></li>',
        [
            'label' => 'item1',
            'options' => ['class' => 'active'],
           // 'url'=>'../lecturer/courses', 
        ],
		
		[
            'label' => 'item2',
         //   'url'=> '../lecturer/requests'
        ],
		
	
    ],
    'options' => ['class' => 'nav-pills nav-stacked admin-menu',
    				 'style' => 'margin:20px 20px 0 0; padding:5px; border-radius: 4px; border:1px solid #DDDDDD'],
]);?>
</div>
<div style="position:relative; width: 75%; float:left;">
<?php echo Html::tag('div', Html::tag('center', Html::tag('h1', 'Имя курса')));
?>
    <div class="form-group">

        <?= Html::tag('div', Html::tag('center', Html::tag('h6','Лекции: кол-во лекций')))?>
        <?=Html::img('h', ['style'=>'width: 150px; height: 150px; float:left; margin: 7px 7px 7px 0;'])?>
         
        <?= Html::tag('div', 'Курс лекций посвящен современному и мощному языку программирования Java. В его рамках дается вводное изложение принципов ООП, необходимое для разработки на Java, основы языка, библиотеки для работы с файлами, сетью, для построения оконного интерфейса пользователя (GUI) и др.
Java изначально появилась на свет ')?>
        <?= Html::tag('div',Html::tag('h4','Автор: Кузницов В.И.'))?>
        
         <?= Html::tag('div',Html::tag('center',Html::tag('h3','План занятий')))?>
        
      
      
      
      
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
