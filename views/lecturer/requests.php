<?php 
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;
Yii::$app->user->returnUrl = Yii::$app->request->getAbsoluteUrl();
?>
<div class="wrapper2 clearfix">
<?php echo Html::tag('div','Запросы', ['id'=>'page_name']);?>
<div style="width: 26%; float:left;">
<?php echo Nav::widget([
    'items' => [
        "<li class='left-info'><b>".$model->name.'</b><br>'.
        $model->email . '<br>' .
        'Степень: '.$model->degree.'</li><hr>', 
        
        "<li><a href='../lecturer/courses'><span class = 'glyphicon glyphicon-list'></span> Мои курсы</a></li>",
        
        "<li class = 'active'><a href='../lecturer/requests'><span class = 'glyphicon glyphicon-question-sign'></span> Запросы на подписку</a></li>",
        
        "<li><a><span class = 'glyphicon glyphicon-list-alt'></span> Тесты (ответы)</a></li>",

        "<li><a href='../lecturer/profile-update'><span class = 'glyphicon glyphicon-pencil'></span> Редактировать профиль</a></li>",

        "<li><a href='#'><span class = 'glyphicon glyphicon-info-sign'></span> Помощь</a></li>",
        
    ],
    'options' => ['class' => 'nav-pills nav-stacked',
                     'style' => 'margin:0 20px 0 10px; padding:5px; border-radius: 4px; border:1px solid #DDDDDD; background:#fff'],
]);?>
</div>
<div style="position:relative; width: 73%; float:left;">
    <div> <?= Html::tag('div', Html::tag('h3', 'Имя студента хочет подписаться на курс название курса  ')); ?>
        <?= Html::submitButton('Разрешить', ['class' => 'btn btn-primary', 'style' => 'float: right; margin-left: 20px; padding: 5px 25px 5px 25px']) ?>
        <?= Html::submitButton('Отказать', ['class' => 'btn btn-primary',  'style' => 'float: right; margin-left: 20px; padding: 5px 32px 5px 32px']) ?>
    </div>
</div>
</div>	
