<?php 
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use app\models\Group;
use yii\helpers\ArrayHelper;

echo Nav::widget([
    'items' => [
        [
            'label' => 'Имя профайла',
            'options' => ['class' => 'active'],
        ],
        [
            'label' => 'Название кафедры', 
        ],     
         [
            'label' => 'Мои курсы',        
        ],        
         [
            'label' => 'Запросы на подписки',         
        ],
        
         [
            'label' => 'Тесты ответы',
        
        ],
        
         [
            'label' => 'Редактировать профиль',       
        ],
        
        [
            'label' => 'Подписки для студента',
       
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
     
       <?= Html::tag('div', 'Описание лекции  Курс лекций посвящен современному и мощному языку программирования Java. В его рамках дается вводное изложение принципов ООП, необходимое для разработки на Java, основы языка, библиотеки для работы с файлами, сетью, для построения оконного интерфейса пользователя (GUI) и др.
Java изначально появилась на свет как язык для создания небольших приложений для Интернета (апплетов), но со временем развилась как универсальная платформа для создания программного ')?>
        <?= Html::submitButton('Редактировать', ['class' => 'btn btn-primary', 'style' => 'float: right; margin: 20px']) ?>
         <?= Html::submitButton('Добавить уроки', ['class' => 'btn btn-primary', 'style' => 'float: right; margin: 20px']) ?>

</p>
          <br />
          <br />
          <?= Html::tag('div', Html::tag('h3', 'Имя студента хочет подписаться на курс название курса  ')); ?>
          
         <?= Html::submitButton('Разрешить', ['class' => 'btn btn-primary', 'style' => 'float: right; margin: 20px; padding: 5px 25px 5px 25px']) ?>
         <?= Html::submitButton('Отказать', ['class' => 'btn btn-primary',  'style' => 'float: right; margin: 20px; padding: 5px 32px 5px 32px']) ?>
        
    </div>
    
     
     

 
  

  
  
  

