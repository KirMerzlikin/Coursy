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
            'options' => ['class' => 'active'],
            'url'=>'../lecturer/courses', 
        ],
		
		[
            'label' => 'Запросы на подписку',
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
<?php echo Html::tag('div', Html::tag('center', Html::tag('h1', 'Имя курса')));
?>
    <div class="form-group">

        <?= Html::tag('div', Html::tag('center', Html::tag('h6','Лекции: кол-во лекций')))?>
        <?=Html::img('h', ['style'=>'width: 150px; height: 150px; float:left; margin: 7px 7px 7px 0;'])?>
         
        <?= Html::tag('div', '3ds Max - очень сложная программа, данный курс создан с единственной целью, чтобы вы убедились, что эту программу, не смотря на ее трудоемкость, можно изучить.
    В курсе подробно рассмотрены все основные аспекты необходимые для работы с 3ds Max. Вы познакомитесь с интерфейсом программы, клавиатурными сокращениями и дублированием объектов. Рассмотрите систему координат рабочей области, группировку, привязку и выравнивание, а также много еще полезного и необходимого для работы с данной программой. Данный курс как нельзя лучше подходит для людей, которые готовы постепенно познакомиться с такой увлекательной и непредсказуемой областью как 3D. ')?>
        <?= Html::submitButton('Редактировать', ['class' => 'btn btn-primary', 'style' => 'float: right;margin-left: 20px']) ?>
        <?= Html::submitButton('Добавить уроки', ['class' => 'btn btn-primary', 'style' => 'float: right; margin-left: 20px']) ?>
    </div>
</div>
</div>