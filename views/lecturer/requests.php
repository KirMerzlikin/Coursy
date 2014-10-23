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
<?php echo Html::tag('div','Запросы', ['id'=>'page_name']);?>
<div style="width: 26%; float:left;">
<?=
    $this->render('menu_left', ['current' => 'requests', 'model' => $model]);
?>
</div>
<div style="position:relative; width: 73%; float:left;">
    <div> <?= Html::tag('div', Html::tag('h3', 'Имя студента хочет подписаться на курс название курса  ')); ?>
        <?= Html::submitButton('Разрешить', ['class' => 'btn btn-primary', 'style' => 'float: right; margin-left: 20px; padding: 5px 25px 5px 25px']) ?>
        <?= Html::submitButton('Отказать', ['class' => 'btn btn-primary',  'style' => 'float: right; margin-left: 20px; padding: 5px 32px 5px 32px']) ?>
    </div>
</div>
</div>	
