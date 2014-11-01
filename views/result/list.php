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

    foreach($testModel as $answerSet)
    {
      $items[$answerSet[0]->getIdStudent()->one()->name . " " . $answerSet[0]->getIdQuestion()->one()->getIdLesson()->one()->getIdCourse()->one()->name . " → " . $answerSet[0]->getIdQuestion()->one()->getIdLesson()->one()->name] = 
        ['content' => 'Content'];

    }

    echo Collapse::widget([
    'items' => $items, 
    ]); ?>
  </div>
</div>


</div>
</div>