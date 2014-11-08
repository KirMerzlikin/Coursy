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
	<?php echo Html::tag('div','Запросы', ['id'=>'page_name']);
  $this->title = "Запросы на подписку"?>
	<div style="width: 26%; float:left;">
		<?=
		    $this->render('menu_left', ['current' => 'requests', 'model' => $model]);
		?>
	</div>
	<div style="position:relative; width: 73%; float:left;">
	    <?php
	    for($i = 0; $i < count($rqProvider); $i++)
	    {
			echo Html::beginTag('div', ['class' => 'panel panel-default', 'id' => $rqProvider[$i]->id]);
			echo Html::beginTag('div', ['class' => 'panel-body']);
			echo Html::tag('div', "Cтудент <b>" . $rqProvider[$i]->getIdStudent()->one()->name . "</b> ".
                			"(email:" .  $rqProvider[$i]->getIdStudent()->one()->email . ") ".
                			"из группы " . $rqProvider[$i]->getIdStudent()->one()->getGroup().
                			" хочет подписаться на курс \"" . $rqProvider[$i]->getCourse()->one()->name . "\".",
                			['id' => 'request_'.$rqProvider[$i]->id]);
       		echo Html::tag('span', "<br/>".Html::button('Подтвердить',
                    			['class' => 'btn btn-success btn-xs', 'style' => 'margin-right:10px;', 'onClick' => 'sendResponseL(\''.$rqProvider[$i]->id.'\',\'' . $rqProvider[$i]->getIdStudent()->one()->email . '\', true)']) .
                 			Html::button('Отклонить',
                   				['class' => 'btn btn-danger btn-xs', 'onClick' => 'openModalL(\''.$rqProvider[$i]->id.'\',\'' . $rqProvider[$i]->getIdStudent()->one()->name . '\',\'' . $rqProvider[$i]->getIdStudent()->one()->email . '\')']), 
                  			['style' => 'float:right;']);
			echo Html::endTag('div');
			echo Html::endTag('div');
	    }
	    if(count($rqProvider) == 0)
	    {
	    	echo Html::tag('div', "<center>Запросы на подписки отсутствуют.</center>", ['class' => "reg-message"]);
	    }
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
        		<textarea rows=5 class="form-control" placeholder='Причина отклонения' id='reasonL' value=''></textarea>
      		</div>
      		<div class="modal-footer">
        		<button id='sendResponseButtonL' type="button" class="btn btn-primary">Отправить</button>
      		</div>
    	</div>
  	</div>
</div>

 <script>
 function sendResponseL(id, email, response, reason)
 {
    if($.trim(reason).length == 0)
       	reason = 'Не указана';
    $.ajax({
      	type     :'POST',
      	cache    : false,
      	url  : '../lecturer/handle-response',
      	data: {'id':id, 'email':email, 'response':response, 'reason':reason},
     	statusCode: {
       	 	500: function(data){alert('Error!\n'+data.responseText);},
        	200: function(){$('#'+id).hide('slow');}
      	}
    });
 }
 function openModalL(id,name, email)
 {
    $('#modalLabelL').text('Кому: ' + name + " (" + email + ")");
    $('#reasonL').val('');

    $('#sendResponseButtonL').click(function()
    {
    	var reason = $('#reasonL').val();
      	if(! (reason.length == 0))
     	{
            sendResponseL(id,email, false, reason);
	    	$('#myModalL').modal('hide');
        }
    });

    $('#myModalL').modal('show');
 }
 </script>