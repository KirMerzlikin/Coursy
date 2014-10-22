<?php 
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = "Урок №" . $model->lessonNumber;
?>
<div class="wrapper2">
  <div class="read_lesson">
 <?php echo Nav::widget([
    'items' => [
        '<li><center><b>'.$model->name.'</b></center></li>',
        '<li class="divider"></li>',
        '<li><center>Студент</center></li>',
        '<li><center>Кафедра:</center></li>',    
		'<li><center>Группа:</center></li>', 
		
		[
		'label' => 'Мои курсы',
	    ],
        
        [
            'label' => 'Название курса',
			'items' => [
				['label'=>'Лекция 1'],
				['label' => 'Лекция 2'],
				['label' => 'Лекция 3'],
			],			
        ],
		
        [
            'label' => 'Редактировать профиль',    
        ],
    ],
    'options' => ['class' => 'nav-pills nav-stacked admin-menu',
    				 'style' => 'margin:20px 20px 0 0; padding:5px; border-radius: 4px; border:1px solid #DDDDDD'],
]);?>
		<div style="width: 75%; margin-left: 24%;">

   			<div class="form-group">
		
				<?php $form = ActiveForm::begin(['method' => 'post', 'action' => 'read_lesson']); ?>
	   
   			 	<?php echo Html::tag('div', Html::tag('center', Html::tag('h2', Html::encode("Курс: {$model->idCourse}"))));?>
				
     		    <?= Html::tag('center', Html::tag('h5', Html::encode("Лекция № {$model->lessonNumber}")))?>
	   
      		  
     			<?= Html::tag('h3', Html::encode("Название: {$model->name}"))?>
	  
	       
 	   		 <?= Html::tag('right', Html::tag('h5','Доп. материал 1')) ?>


			 <?= Html::tag('right', Html::tag('h5','Доп. материал 2')) ?>
			 
	 		    <? Html::tag('div', Html::encode("$model->description}"))?>
				
			    <?= Html::tag('div', 'Бла Бла БлаБла Бла Бла Бла Бла vvБлаБлаБлаБлаБлаБла Бла Бла Бла Бла Бла v Бла Бла Бла Бла Бла Бла Бла Бла Бла Бла Бла Бла Бла v v Бла v Бла Бла БлаБла БлаБлаБла БлаБла БлаБла БлаБлаБлаБлаБлаБла БлаБла Бла Бла Бла Бла Бла Бла Бла БлаБла  Бла Бла БламБлаБла Бла Бла Бла Бла Бла Бла vv  v Бла Бла БлаБла Бла Бла Бла Блаv Бла Бла м vБлаБла Блам Бла Бла Бла v БлаБла Бла Бла м БлаБлаБлаБлаБлаБла vБла БлаБлаБлаБлаБлаБла Бла м м м м м  Бла  мvБлаБлаvБламБлаБлаБлаБлаБла м Бла Бла Бла Бла Бла Бла Бла  БлаБлаБлаБла м м м м м м мм БлаБлаБламБлаБлаБлаБлаБлаБламБлам vБла Бла мм мvмv  vБлаБлаБлаБлаБла Бла Бла Бла Бла Бла Бла Бла Бла Блам БлаБлаБла БлаБла БлаБлаБлаБлаБлаБла Бла БлаБлаБлаБлаБлаБлаБлаБлаБла Бла Бла Бла Бла Бла Бла Бла Бла Бла Бла Бла Бла Бла Бла Бла v Бла Бла Бла Бла Бла Бла Бла v Бла v Бла Бла v Бла  Бла Бла Бла Бла БлаБла Бла Бла Бла Бла vvБлаБлаБлаБлаБлаБла Бла Бла Бла Бла Бла v Бла Бла Бла Бла Бла Бла Бла Бла Бла Бла Бла Бла Бла v v Бла v Бла Бла БлаБла БлаБлаБла БлаБла БлаБла БлаБлаБлаБлаБлаБла БлаБла Бла Бла Бла Бла Бла Бла Бла БлаБла  Бла Бла БламБлаБла Бла Бла Бла Бла Бла Бла vv  v Бла Бла БлаБла Бла Бла Бла Блаv Бла Бла м vБлаБла Блам Бла Бла Бла v БлаБла Бла Бла м БлаБлаБлаБлаБлаБла vБла БлБлаБ' )?>
				
				<?= Html::tag('center', LinkPager::widget(['pagination' => $pagination])) ?> 
				
			 <?= Html::submitButton('Начать тест', ['class' => 'btn btn-primary', 'style' => 'float: right; margin-left: 20px;                  padding: 5px 25px 5px 25px']) ?>
				
		       
				
	            
                 <?php ActiveForm::end(); ?>
  
   	    	 </div>
		</div>
	</div>	
</div>