<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Course */

$this->title = 'Новый курс';
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
  <div class="panel-body" style = 'padding-top:10px'>
    <?= $this->render('_form', [
        'model' => $crModel,
        'is_lecturer' => $is_lecturer,
    ]) ?>
</div>
</div>
</div>
</div>

