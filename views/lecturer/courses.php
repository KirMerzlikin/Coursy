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
<?php echo Html::tag('div','Курсы', ['id'=>'page_name']);?>
<div style="width: 26%; float:left;">
<?php echo Nav::widget([
    'items' => [
        "<li class='left-info'><b>".$model->name.'</b><br>'.
        $model->email . '<br>' .
		'Степень: '.$model->degree.'</li><hr>', 
        
        "<li class = 'active'><a href='../lecturer/courses'><span class = 'glyphicon glyphicon-list'></span> Мои курсы</a></li>",
		
		"<li><a href='../lecturer/requests'><span class = 'glyphicon glyphicon-question-sign'></span> Запросы на подписку</a></li>",
		
		"<li><a><span class = 'glyphicon glyphicon-list-alt'></span> Тесты (ответы)</a></li>",

        "<li><a href='../lecturer/profile-update'><span class = 'glyphicon glyphicon-pencil'></span> Редактировать профиль</a></li>",

        "<li><a href='#'><span class = 'glyphicon glyphicon-info-sign'></span> Помощь</a></li>",
        
    ],
    'options' => ['class' => 'nav-pills nav-stacked',
    				 'style' => 'margin:0 20px 0 10px; padding:5px; border-radius: 4px; border:1px solid #DDDDDD; background:#fff'],
]);?>
</div>
<div style="position:relative; width: 73%; float:left;">
<?php 

    for($i = 0; $i < $model->getCourses()->count(); $i++)
    {
    /*echo Html::beginTag('div', ['class' => 'form-group']); 

        echo Html::tag('div', Html::tag('center', Html::tag('h1', $model->getCourses()->all()[$i]->name)));

        echo Html::tag('div', Html::tag('center', Html::tag('h6','Лекции:' . $model->getCourses()->all()[$i]->getLessons()->count())));
        echo Html::img('h', ['style'=>'width: 150px; height: 150px; float:left; margin: 7px 7px 7px 0; background-image:url("http://placehold.it/150x150")']);
         
        echo Html::tag('div', $model->getCourses()->all()[$i]->description);
        echo Html::a('Редактировать', '../course/view?id=' . $model->getCourses()->all()[$i]->id,['class' => 'btn btn-primary', 'style' => 'float: right;margin-left: 20px; margin-top:10px']);
    echo Html::endTag('div', ['class' => 'form-group']);*/

    echo Html::beginTag('div', ['class' => 'panel panel-default']); 
    echo Html::tag('div', Html::tag('span', $model->getCourses()->all()[$i]->name . 
        ' (' . $model->getCourses()->all()[$i]->getLessons()->count() . ' лекций)', ['class' => 'panel-title', 'style' => 'float:left; width:80%;']) . 
        Html::a('Редактировать', '../course/view?id=' . $model->getCourses()->all()[$i]->id,['class' => 'btn btn-xs btn-primary', 'style' => 'float: right;margin-left: 20px;']), 
        ['class' => 'panel-heading clearfix']);
    echo Html::beginTag('div', ['class' => 'panel-body']);
    echo Html::img('h', ['style'=>'width: 75px; height: 75px; float:left; margin-right: 10px; background-image:url("http://placehold.it/75x75")']);
    echo Html::tag('div', $model->getCourses()->all()[$i]->description);
    echo Html::endTag('div'); 
    echo Html::endTag('div'); 
    }
?>
</div>
</div>
