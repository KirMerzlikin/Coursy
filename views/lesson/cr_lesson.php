<?php 
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;
$this->title = "Создание урока";
?><div class="wrapper2">

<?php echo Html::tag('div','Создание урока', ['id'=>'page_name']);?>
 <?php echo Nav::widget([
    'items' => [
        '<li><center><b>'.$model->name.'</b></center></li>',
        '<li class="divider"></li>',
        '<li><center>Лектор</center></li>',
        '<li><center>Кафедра:</center></li>',    
		'<li><center>Степень:</center></li>', 
		
		[
		'label' => 'Мои курсы',
	    ],
        
        [
            'label' => 'Название курсаКурс',
			'items' => [
				[
				'label'=>'Список лекций',
			],
				['label' => 'Добавить лекцию'],
			],			
        ],
		
		[
            'label' => 'Запросы на подписку',
        ],
		
		[
            'label' => 'Тесты (ответы)',
        ],

        [
            'label' => 'Редактировать профиль',    
        ],
    ],
    'options' => ['class' => 'nav-pills nav-stacked admin-menu',
    				 'style' => 'margin:20px 20px 0 0; padding:5px; border-radius: 4px; border:1px solid #DDDDDD'],
]);?>
<div style="width: 75%; margin-left: 24%;">
<?php echo Html::tag('div', Html::tag('center', Html::tag('h2', 'Имя курса')));
?>
    <div class="form-group">
     
       <?= Html::tag('div', Html::tag('Left', Html::tag('h3','Урок №:')))?>
       <?php $form = ActiveForm::begin(['method' => 'post', 'action' => 'cr_lesson']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
	 
	 <?=Html::tag('h5', 'Добавить материалы:');?>
	 
	 <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary', 'style' => 'float: left; margin-left: 5px; padding: 5px 25px 5px 25px']) ?>
	  <?= Html::tag('div', Html::tag('h6','Название добавленного объекта')) ?>
 </br> </br>
	  <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary', 'style' => 'float: left; margin-left: 5px; padding: 5px 25px 5px 25px']) ?>
	  <?= Html::tag('div', Html::tag('h6','Название добавленного объекта')) ?>
  </br></br>
	   <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary', 'style' => 'float: left; margin-left: 5px; padding: 5px 25px 5px 25px']) ?>
	    <?= Html::tag('div', Html::tag('h6','Название добавленного объекта')) ?>
	   
 	 <?= Html::submitButton('Создать', ['class' => 'btn btn-primary', 'style' => 'float: right; margin-left: 20px; padding: 5px 25px 5px 25px']) ?>
	 
	  <?= Html::submitButton('Редактировать', ['class' => 'btn btn-primary', 'style' => 'float: right; margin-left: 20px; padding: 5px 25px 5px 25px']) ?>
	 
     <div class="form-group">
        
  
    </div>
	</div>
	</div>
