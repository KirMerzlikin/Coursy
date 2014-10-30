<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;

?>
<div class="wrapper2 clearfix">
<?php echo Html::tag('div','Тест', ['id'=>'page_name']);?>
<div style="width: 26%; float:left;">
<?=
    $this->render('..\student\menu_left', ['current' => 'subscriptions', 'model' => $stModel]);
?>
</div>

<div style="position:relative; width: 73%; float:left;">
  
  <div class="panel panel-default">
    <div class="panel-body">
      <?php
        $questions = $qListModel->all();
        shuffle($questions);
        $count = $qListModel->count();
        for($i = 0; $i < $count; $i++)
        {
          echo Html::tag('span', $questions[$i]->text, 
            ['class' => 'question', 'id' => $questions[$i]->id, 'hidden' => 'true']);
        }
        echo $this->render('view', ['model' => $questions[0]]);
      ?>

      <center>
        <button class='btn btn-default disabled' id = 'btn-prev' style='margin-top:15px' onclick="prevClick()"><span class = 'glyphicon glyphicon-chevron-left'></span> Назад</button>
        <button class='btn btn-default' id = 'btn-next' style='margin-top:15px' onclick="nextClick()">Дальше <span class = 'glyphicon glyphicon-chevron-right'></span></button>
        <?= Html::button('Завершить', ['class' => 'btn btn-primary', 'style' => 'margin-top:15px; float:right', 
          'onclick' => 'completeClick(' . $stModel->id . ')']) ?>
      </center>

    </div>
  </div>

  <script>

    function Question(id, text)
    {
      this.id = id;
      this.text = text;
      this.answer = "";
    }

    var questions = [];
    var index = 0;

    window.onload= function()
      {
        var spans = $(".question");

        (function()
        {
          for(var i = 0; i < spans.length; i++)
          {
            questions.push(new Question(spans[i].id, spans[i].innerHTML));
          }
        })();

        
        if(index == questions.length - 1)
          $('#btn-next').addClass("disabled");
                  
      };

    function nextClick()
    {
      if(! $('#btn-next').hasClass("disabled"))
      {
        $('#btn-prev').removeClass("disabled");
        questions[index].answer = $('#question-answer').val();
        index = index + 1;
        $('#question-text').text(questions[index].text);
        $('#question-answer').val(questions[index].answer);
        $('#question-answer').focus();

        if(index == questions.length - 1)
          $('#btn-next').addClass("disabled");
      }
    }

    function prevClick()
    {
      if(! $('#btn-prev').hasClass("disabled"))
      {
        $('#btn-next').removeClass("disabled");
        questions[index].answer = $('#question-answer').val();
        index = index - 1;
        $('#question-text').text(questions[index].text);
        $('#question-answer').val(questions[index].answer);
        $('#question-answer').focus();
        
        if(index == 0)
          $('#btn-prev').addClass("disabled");
      }
    }

    function checkAnswers()
    {
      for(var i = 0; i < questions.length; i++)
      {
        if(questions[i].answer.trim().length == 0)
        {
          alert("Пожалуйста, ответьте на все вопросы!");
          return false;
        }
      }
      return true;
    }

    function completeClick(id)
    {
      questions[index].answer = $('#question-answer').val();

      var qData = {};
      for(var i = 0; i < questions.length; i++)
      {
        qData[questions[i].id] = questions[i].answer;
      }

      if(checkAnswers())
      {
        $.ajax({
          type     :'POST',
          cache    : false,
          url  : 'handle-completion',
          data: {'idStudent':id, 'answers':qData},
          statusCode: {
            500: function(data){alert('Error!\n'+data.responseText);},
            200: function(){alert('Тест завершен.\nОжидайте письма с результатами.'); history.go(-1);}
          }
        });
      }
    }
    

  </script>

</div>
</div>