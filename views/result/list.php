<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\bootstrap\Collapse;

?>
<div class="wrapper2 clearfix">
<?php echo Html::tag('div','Тесты', ['id'=>'page_name']);
$this->title = 'Проверка тестов'?>
<div style="width: 26%; float:left;">
<?=
		$this->render('..\lecturer\menu_left', ['current' => 'results', 'model' => $lcModel]);
?>
</div>

<div style="position:relative; width: 73%; float:left;">

<div class="panel panel-default">
	<div class="panel-heading"><b>Ответы студентов на вопросы тестов</b></div>
	<div class="panel-body">
		<?php 

	$items = [];
	foreach($testModel as $answerSet)
	{
	  $content = "";
	  foreach($answerSet as $answer)
	  {
		$content .= "<div><b>Вопрос: </b>" . $answer->getIdQuestion()->one()->text . "<br>";
		$content .= "<b>Правильный ответ: </b>" . $answer->getIdQuestion()->one()->answer . "<br>";
		$content .= "<b>Ответ студента: </b>" . $answer->answer . "<br>" . 
		  "<div class='btn-group btn-toggle' id='". $answer->idStudent . "_" . $answer->getIdQuestion()->one()->idLesson ."' style='float:right'> 
			<button class='btn btn-xs btn-default'>Верно</button>
			<button class='btn btn-xs btn-primary active'>Неверно</button>
		  </div><br>".
		  "<div style='background-color: #E2E2E2; height: 1px; margin: 10px 0;'></div></div>" ;
	  }
	  $content .= "<center>Оценка: <span id='mark'>0</span>    <button class='btn btn-xs btn-success' style='vertical-align:top' onclick='sendSubmit(".
	   $answer->idStudent . ", " . $answer->getIdQuestion()->one()->idLesson .
	   ")'>Подтвердить</button><button class='btn btn-xs btn-primary' style='margin-left:10px;' onclick='openModalS(\"".
	   $answer->getIdStudent()->one()->email."\",\"".$answer->getIdQuestion()->one()->getIdLesson()->one()->name."\",\"".
	   $answer->getIdQuestion()->one()->getIdLesson()->one()->getIdCourse()->one()->name."\")'>Связаться с студентом</button></center>";

	  $items[$answerSet[0]->getIdStudent()->one()->name . " (Лекция \"" . $answerSet[0]->getIdQuestion()->one()->getIdLesson()->one()->name . "\")"] = 
		['content' => $content];

	}

	echo Collapse::widget([
	'items' => $items, 
	]); ?>
  </div>
</div>


</div>
</div>

<div class="modal fade bs-example-modal-sm" id='myModalS' tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="modalLabelS"></h4>
			</div>
			<div class="modal-body">
				<textarea rows=5 class="form-control" placeholder='Текст письма' id='textS' value=''></textarea>
			</div>
			<div class="modal-footer">
				<button id='sendResponseButtonS' type="button" class="btn btn-primary">Отправить</button>
			</div>
	  </div>
	</div>
</div>

<script>

function sendMail(email, lesson, course, text)
{
	$.ajax({
	  	type     :'POST',
	  	cache    : false,
	  	url  : '../lecturer/send-mail',
	  	data: {'email':email, 'lesson':lesson, 'course':course,'text':text},
	  	statusCode: {
			500: function(data){alert('Error!\n'+data.responseText);}
	  	}
	});
 }

function openModalS(email, lesson, course)
{
	$('#modalLabelS').text('Связаться с студентом.');
	$('#textS').val('');

	$('#sendResponseButtonS').click(function()
	{
		var text = $('#textS').val();
		if(! (text.length == 0))
		{
			sendMail(email, lesson, course, text);
			$('#myModalS').modal('hide');
		}
	});

	$('#myModalS').modal('show');
}

var countArray = {};

window.onload= function()
{
	$('.btn-toggle').click(function() {
	  	$(this).find('.btn').toggleClass('active');
	  	$(this).find('.btn').toggleClass('btn-primary');
	  	$(this).find('.btn').toggleClass('btn-default');

	  	if(isNaN(countArray[this.id]))
			countArray[this.id] = 0;

	  	if($(this).find('.btn.btn-primary').text() == 'Верно')
			countArray[this.id] += 1;
	  	else
			countArray[this.id] -= 1;

	  	var mark = Math.round(countArray[this.id] / $(this).parents('.panel-collapse').find('.btn-toggle').size() * 100);
	  	$(this).parent().parent().find('#mark').text(mark);
	});

};

function sendSubmit(idStudent, idLesson)
{
	var mark = $('#' + idStudent + "_" + idLesson + '.btn-toggle').parents('.panel-collapse').find('#mark').text();

	$.ajax({
	  	type     :'POST',
	  	cache    : false,
	  	url  : 'handle-result',
	  	data: {'idStudent':idStudent, 'idLesson':idLesson, 'mark':mark},
	  	statusCode: {
			500: function(data){alert('Error!\n'+data.responseText);},
			200: function(){$('#' + idStudent + "_" + idLesson + '.btn-toggle').parents('.panel-collapse').parent().hide('slow')}
		}
	});
}

</script>