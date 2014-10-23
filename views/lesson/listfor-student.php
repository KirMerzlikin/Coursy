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
<?php echo Html::tag('div','Список уроков к курсу', ['id'=>'page_name']);?>
<div style=" width:100%; height:1px; clear:both;">
<div style="width: 24%; float:left;">
 <?php echo Nav::widget([
    'items' => [
        '<li><center><b>'.$model->name.'</b></center></li>',
        '<li class="divider"></li>',
        '<li><center>Студент</center></li>',
        [
            'label' => 'Группа',
        ],
		
		[
            'label' => 'Подписки',
        ],
		
		[
            'label' => 'Тесты',
        ],
		
		[
            'label' => 'Редактировать профиль',
        ],
	
    ],
    'options' => ['class' => 'nav-pills nav-stacked admin-menu',
    				 'style' => 'margin:20px 20px 0 0; padding:5px; border-radius: 4px; border:1px solid #DDDDDD'],
]);?>
</div>
<div style="position:relative; width: 75%; float:left;">

    <div class="form-group">
     
       <?php $form = ActiveForm::begin(['method' => 'post', 'action' => 'list']); ?>
 <?= Html::tag('div', Html::tag('center', Html::tag('h3','Имя курса')))?>

	
	
	<ul>
	 
    <li>
     
         
        <?= Html::tag('div', 'Урок №1')?>
        <?= Html::tag('div',Html::tag('h4','В уроке речь пойдёт о...'))?>
        
        
    	 <?= Html::submitButton('Просмотр', ['class' => 'btn btn-primary', 'style' => 'float: right; margin-left: 20px; padding: 5px 25px 5px 25px']) ?>
   	 

    </li>
	<br></br>
	
	<li>
     
         
        <?= Html::tag('div', 'Урок №2')?>
        <?= Html::tag('div',Html::tag('h4','В уроке речь пойдёт о...'))?>
        
        
    	 <?= Html::submitButton('Просмотр', ['class' => 'btn btn-primary', 'style' => 'float: right; margin-left: 20px; padding: 5px 25px 5px 25px']) ?>
   	 

    </li>
	<br></br>
     
    
    
   
    

</ul>

	</div>
	</div>