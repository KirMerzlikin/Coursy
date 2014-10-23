<?php

use yii\helpers\Html;
use yii\widgets\ListView;

?>
<div class="wrapper2 clearfix">
<?php echo Html::tag('div','Курсы', ['id'=>'page_name']);?>
<div style="width: 26%; float:left;">
<?=
    $this->render('..\lecturer\menu_left', ['current' => 'courses', 'model' => $lcModel]);
?>
</div>

<div style="position:relative; width: 73%; float:left;">

<div class="panel panel-default">
  <div class="panel-heading"><b>Общая информация</b></div>
  <div class="panel-body">
    <?= $this->render('_form', [
        'model' => $lsModel
    ]) ?>
  </div>
</div>