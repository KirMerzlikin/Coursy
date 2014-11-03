<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use app\models\Group;
use yii\helpers\ArrayHelper;
Yii::$app->user->returnUrl = Yii::$app->request->getAbsoluteUrl();?>
<div class="wrapper2 clearfix">
	<?php echo Html::tag('div','Курсы', ['id'=>'page_name']);?>
	<div style="width: 26%; float:left;">
		<?=
		    $this->render('..\student\menu_left', ['current' => $current, 'model' => $stModel]);
		?>
	</div>
	<div style="position:relative; width: 73%; float:left;">

		<?php

			echo Html::beginTag('div', ['class' => 'panel panel-default']);
			echo Html::tag('div', Html::tag('span', 'Курс: ' . $model->name, ['class' => 'panel-title', 'style' => 'float:left; width:80%;']).
			    	Html::tag('span', 'Лектор: '.$model->getIdLecturer()->one()->name, ['style' => 'float:right; width:20%;']),
			    	['class' => 'panel-heading clearfix']);
			echo Html::beginTag('div', ['class' => 'panel-body']);
			echo Html::tag('div', Html::tag('div', $model->description));
			echo Html::tag('br');
			echo Html::tag('div', 'Лекции: ');

			if($subscribed == 1){
				echo Html::ul($model->getLessons()->where(['published' => 1])->orderBy('lessonNumber')->all(), [
			        'class' => 'list-group',
			        'item' => function($lesson, $index)
			        {
			          	return Html::tag('li',
			          	"<b>" . Html::a('Лекция #'.$lesson->lessonNumber.'. '.$lesson->name , '../lesson/view-lesson?id='.$lesson->id,['class' => '']), ['class' => 'list-group-item']);
			        }
			    ]);
			}
		    else
		    {
		    	echo Html::ul($model->getLessons()->where(['published' => 1])->orderBy('lessonNumber')->all(), [
		        'class' => 'list-group',
		        'item' => function($lesson, $index)
		        {
		          	return Html::tag('li',
		          		"<b>" . Html::tag('span','Лекция #'.$lesson->lessonNumber.'. '.$lesson->name , ['class' => '']), ['class' => 'list-group-item']);
		        }
		    ]);
		    }

			if($subscribed == 0)
			{
				if($stModel->getSubscriptions()->where(['idCourse' => $model->id])->one() == null)
				{
			   		echo Html::a('Подписаться', '../course/subscribe?id='.$model->id ,['class' => 'btn btn-x btn-success', 'style' => 'float: right;']);
				}
				else
				{
					echo Html::tag('div','<b>Запрос на  подписку  находится  на рассмотрении у  лектора.</b>', ['style' => 'float:right;']);
				}
			}
			else
			{
				echo Html::button('Связаться с лектором',['class' => 'btn btn-x btn-primary', 'style' => 'float: right;', 'onclick' => 'openModalL(\''.$model->getIdLecturer()->one()->email.'\')']);
			}
			echo Html::endTag('div');
			echo Html::endTag('div');
		?>
	</div>
</div>

<div class="modal fade bs-example-modal-sm" id='myModalL' tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  	<div class="modal-dialog">
   		<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title" id="modalLabelL"></h4>
      		</div>
      		<div class="modal-body">
        		<textarea rows=5 class="form-control" placeholder='Текст письма' id='textL' value=''></textarea>
      		</div>
      		<div class="modal-footer">
        		<button id='sendResponseButtonL' type="button" class="btn btn-primary">Отправить</button>
      		</div>
    	</div>
  	</div>
</div>

 <script>
 function sendMail(email, text)
 {
    $.ajax({
      type     :'POST',
      cache    : false,
      url  : '../student/send-mail',
      data: {'email':email, 'text':text},
      statusCode: {
        500: function(data){alert('Error!\n'+data.responseText);}
      }
    });
 }

 function openModalL(email)
 {
    $('#modalLabelL').text('Связаться с лектором.');
    $('#textL').val('');

    $('#sendResponseButtonL').click(function()
    {
      	var text = $('#textL').val();
      	if(! (text.length == 0))
     	{
            sendMail(email, text);
      		$('#myModalL').modal('hide');
        }
    });

    $('#myModalL').modal('show');
 }
 </script>