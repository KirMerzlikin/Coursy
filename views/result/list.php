<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\bootstrap\Collapse;

?>
<div class="wrapper2 clearfix">
<?php echo Html::tag('div','Тесты', ['id'=>'page_name']);?>
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
      $content .= "<center>Оценка: <span id='mark'>0</span>    <button class='btn btn-xs btn-success' style='vertical-align:top' onclick='sendSubmit(". $answer->idStudent . ", " . $answer->getIdQuestion()->one()->idLesson .")'>Подтвердить</button></center>";

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

<script>

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