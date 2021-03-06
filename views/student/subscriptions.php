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
	<?php echo Html::tag('div','Подписки', ['id'=>'page_name']);
    $this->title = "Подписки"?>
	<div style="width: 26%; float:left;">
		<?=
		    $this->render('menu_left', ['current' => 'subscriptions', 'model' => $model]);
		?>
	</div>

	<div style="position:relative; width: 73%; float:left;">
		<?php
			$active = false;
		    for($i = 0; $i < $model->getSubscriptions()->count(); $i++)
		    {
		    	if($model->getSubscriptions()->all()[$i]->active == 1)
		    	{
				    echo Html::beginTag('div', ['class' => 'panel panel-default']);
				    echo Html::tag('div', Html::tag('span', $model->getSubscriptions()->all()[$i]->getCourse()->one()->name.' (' . $model->getSubscriptions()->all()[$i]->getCourse()->one()->getLessons()->count() . ' лекц.)', ['class' => 'panel-title', 'style' => 'float:left; width:80%;']).
				    	Html::tag('span', 'Лектор: '.$model->getSubscriptions()->all()[$i]->getCourse()->one()->getIdLecturer()->one()->name, ['style' => 'float:right; width:20%;']),
				    	['class' => 'panel-heading clearfix']);
				    echo Html::beginTag('div', ['class' => 'panel-body']);
				    $image = 'https://api.fnkr.net/testimg/75x75/cccccc/FFF/?text=No+image';
	                if ($model->getSubscriptions()->all()[$i]->getCourse()->one()->image!="")
	                    $image = Yii::$app->request->BaseUrl.'/'.$model->getSubscriptions()->all()[$i]->getCourse()->one()->image;
	                echo Html::img($image, ['style'=>'width: 75px; height: 75px; float:left; margin-right: 10px;']);
				    echo Html::tag('div', mb_substr($model->getSubscriptions()->all()[$i]->getCourse()->one()->description, 0, 1000).'...');
				    echo Html::tag('br');
				    echo Html::a('Перейти', '../course/view-course?id=' . $model->getSubscriptions()->all()[$i]->getCourse()->one()->id,['class' => 'btn btn-x btn-primary', 'style' => 'float: right;']);
				    echo Html::button('Отписаться', ['class' => 'btn btn-x btn-danger', 'style' => 'float: right; margin-right:10px; padding: 6px 16px;', 'onclick' => 'askUnsubscribeConfirmation(\''.$model->getSubscriptions()->all()[$i]->id.'\')']);
				    echo Html::endTag('div');
				    echo Html::endTag('div');
				    $active = true;
				}
		    }
		    if(!$active)
		    {
		    	echo Html::tag('div', "<center>Вы не подписаны ни на один курс.</center>", ['class' => "reg-message"]);
		    }
		?>
	</div>
</div>
<script>
function askUnsubscribeConfirmation(id)
{
    if (confirm('Вы уверены, что хотите отписаться?'))
    {
    	$.ajax({
      		type     :'POST',
      		cache    : false,
      		url  : '../course/unsubscribe',
      		data: {'id':id},
      		statusCode: {
        	500: function(data){alert('Error!\n'+data.responseText);},
        	200: function(){$('#'+id).hide('slow');}
      	}
    	});
    }
}
</script>
