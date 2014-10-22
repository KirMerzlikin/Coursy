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
<?php echo Html::tag('div','Список курсов', ['id'=>'page_name']);?>
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

    <div class="form-group">
     
       <?php $form = ActiveForm::begin(['method' => 'post', 'action' => 'list']); ?>


	
	
	<ul>
	 
    <li>
      <?= Html::tag('div', Html::tag('center', Html::tag('h3','Имя курса')))?>
    <?= Html::tag('div', Html::tag('center', Html::tag('h6','Лекции: кол-во лекций')))?>
        <?=Html::img('h', ['style'=>'width: 150px; height: 150px; float:left; margin: 7px 7px 7px 0;'])?>
         
        <?= Html::tag('div', 'Курс лекций посвящен современному и мощному языку программирования Java. В его рамках дается вводное изложение принципов ООП, необходимое для разработки на Java, основы языка, библиотеки для работы с файлами, сетью, для построения оконного интерфейса пользователя (GUI) и др.
Java изначально появилась на свет как язык для создания небольших приложений для Интернета (апплетов), но со временем развилась как универсальная платформа для создания программного обеспечения, которое работает буквально везде – от мобильных устройств и смарт-карт до мощных серверов. Данный курс начинается с изложения истории появления и развития Java. ')?>
        <?= Html::tag('div',Html::tag('h4','Автор: Кузницов В.И.'))?>
        
        
    	 <?= Html::submitButton('Подписаться', ['class' => 'btn btn-primary', 'style' => 'float: right; margin-left: 20px; padding: 5px 25px 5px 25px']) ?>
   	 

    </li>
     
     <li>
      <hr />
     dcefvcf
     </li>
    
   
    

</ul>

	</div>
	</div>