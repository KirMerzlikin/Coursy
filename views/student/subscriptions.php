<?php 
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use app\models\Group;


use yii\helpers\ArrayHelper;
Yii::$app->user->returnUrl = Yii::$app->request->getAbsoluteUrl();
?>

<div class='wrapper2 clearfix'>
<?php echo Html::tag('div','Подписки', ['id'=>'page_name']);?>
<div style="width: 26%; float:left;">
<?=
    $this->render('menu_left', ['current' => 'subscriptions', 'model' => $model]);
?>
</div>

<div style="position:relative; width: 73%; float:left;">
<?php 
    for($i = 0; $i < $model->getSubscribtions()->count(); $i++)
    {
    	if($model->getSubscribtions()->all()[$i]->active == 1)
    	{
		    echo Html::beginTag('div', ['class' => 'panel panel-default']);
		    echo Html::tag('div', Html::tag('span', $model->getSubscribtions()->all()[$i]->getCourse()->one()->name.' (' . $model->getSubscribtions()->all()[$i]->getCourse()->one()->getLessons()->count() . ' лекц.)', ['class' => 'panel-title', 'style' => 'float:left; width:80%;']).
		    	Html::tag('span', 'Лектор: '.$model->getSubscribtions()->all()[$i]->getCourse()->one()->getIdLecturer()->one()->name, ['style' => 'float:right; width:20%;']), 
		    	['class' => 'panel-heading clearfix']);
		    echo Html::beginTag('div', ['class' => 'panel-body']);
		    echo Html::img('h', ['style'=>'width: 75px; height: 75px; float:left; margin-right: 10px; background-image:url("http://placehold.it/75x75")']);
		    echo Html::tag('div', mb_substr($model->getSubscribtions()->all()[$i]->getCourse()->one()->description, 0, 1000).'...');
		    echo Html::tag('br');
		    echo Html::a('Перейти', '../course/view-course?id=' . $model->getSubscribtions()->all()[$i]->getCourse()->one()->id,['class' => 'btn btn-x btn-primary', 'style' => 'float: right;']);
		    echo Html::endTag('div'); 
		    echo Html::endTag('div');
		} 
    }
?>
</div>
</div>
     
     

 
  

  
  
  

