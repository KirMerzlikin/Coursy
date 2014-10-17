<?php 
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;

echo Nav::widget([
    'items' => [
        [
            'label' => 'Имя Пользователя',
            'options' => ['class' => 'active'],
        ],
        [
            'label' => 'Название кафедры', 
        ],     
         [
            'label' => 'Степень',        
        ],        
         [
            'label' => 'Запросы на подписки',         
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
]);

echo Html::beginTag('div', ['class' => 'col-lg-9']);
echo Html::tag('div', Html::tag('center', Html::tag('h1', 'Имя курса')));

?>


    <div class="form-group">
    <p>
     <?= Html::tag('div', Html::tag('center', Html::tag('h6','Лекции: кол-во лекций')))?>
    <?=Html::img('h', ['style'=>'width: 150px; height: 150px; float:left; margin: 7px 7px 7px 0;'])?>
     
       <?= Html::tag('div', '3ds Max - очень сложная программа, данный курс создан с единственной целью, чтобы вы убедились, что эту программу, не смотря на ее трудоемкость, можно изучить.
В курсе подробно рассмотрены все основные аспекты необходимые для работы с 3ds Max. Вы познакомитесь с интерфейсом программы, клавиатурными сокращениями и дублированием объектов. Рассмотрите систему координат рабочей области, группировку, привязку и выравнивание, а также много еще полезного и необходимого для работы с данной программой. Данный курс как нельзя лучше подходит для людей, которые готовы постепенно познакомиться с такой увлекательной и непредсказуемой областью как 3D. ')?>
        <?= Html::submitButton('Редактировать', ['class' => 'btn btn-primary', 'style' => 'float: right; margin: 20px']) ?>
         <?= Html::submitButton('Добавить уроки', ['class' => 'btn btn-primary', 'style' => 'float: right; margin: 20px']) ?>

</p>
          <br />
          <br />
          <?= Html::tag('div', Html::tag('h3', 'Имя студента хочет подписаться на курс название курса  ')); ?>
          
         <?= Html::submitButton('Разрешить', ['class' => 'btn btn-primary', 'style' => 'float: right; margin: 20px; padding: 5px 25px 5px 25px']) ?>
         <?= Html::submitButton('Отказать', ['class' => 'btn btn-primary',  'style' => 'float: right; margin: 20px; padding: 5px 32px 5px 32px']) ?>
        
    </div>