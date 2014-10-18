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
<?php echo Html::tag('div','Profile', ['id'=>'page_name']);?>
<div style=" width:100%; height:1px; clear:both;">
<div style="width: 24%; float:left;">
 <?php echo Nav::widget([
    'items' => [
        '<li><center><b>'.$model->name.'</b></center></li>',
        '<li class="divider"></li>',
        '<li><center>Лектор</center></li>',
        /*'<li><center>Кафедра: '.$model->getDepartment().'</center></li>',*/    
		'<li><center>Степень: '.$model->degree.'</center></li>', 
        
        [
            'label' => 'Мои курсы',
            
            'url'=>'../lecturer/courses', 
        ],
		
		[
            'label' => 'Запросы на подписку',
            'options' => ['class' => 'active'],
            'url'=> '../lecturer/requests'
        ],
		
		[
            'label' => 'Тесты (ответы)',
        ],

        [
            'label' => 'Редактировать профиль',
            'url'=>'../lecturer/profile-update',    
        ],
    ],
    'options' => ['class' => 'nav-pills nav-stacked admin-menu',
    				 'style' => 'margin:20px 20px 0 0; padding:5px; border-radius: 4px; border:1px solid #DDDDDD'],
]);?>
</div>
<div style="position:relative; width: 75%; float:left;">
    <div> <?= Html::tag('div', Html::tag('h3', 'Имя студента хочет подписаться на курс название курса  ')); ?>
        <?= Html::submitButton('Разрешить', ['class' => 'btn btn-primary', 'style' => 'float: right; margin-left: 20px; padding: 5px 25px 5px 25px']) ?>
        <?= Html::submitButton('Отказать', ['class' => 'btn btn-primary',  'style' => 'float: right; margin-left: 20px; padding: 5px 32px 5px 32px']) ?>
    </div>
</div>
</div>	
