<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;

?>
<div class="wrapper2 clearfix">
<?php echo Html::tag('div','Подписки', ['id'=>'page_name']);?>
<div style="width: 26%; float:left;">
<?=
    $this->render('..\student\menu_left', ['current' => 'subscriptions', 'model' => $stModel]);
?>
</div>

<div style="position:relative; width: 73%; float:left;">

</div>
</div>