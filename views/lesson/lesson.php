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
<?php echo Html::tag('div','Лекции', ['id'=>'page_name']);
    $this->title = "Лекция\"" . $model->name ."\""?>
<div style="width: 26%; float:left;">
<?=
    $this->render('../student/menu_left', ['current' => 'subscriptions', 'model' => $stModel]);
?>
</div>

<div style="position:relative; width: 73%; float:left;">

<?php

	echo Html::beginTag('div', ['class' => 'panel panel-default']);
	echo Html::tag('div', Html::tag('span', 'Лекция #' . $model->lessonNumber.': '.$model->name, ['class' => 'panel-title', 'style' => 'float:left; width:80%;']).
	    	Html::tag('span', 'Курс: '.$model->getIdCourse()->one()->name, ['style' => 'float:right; width:20%;']),
	    	['class' => 'panel-heading clearfix']);
	echo Html::beginTag('div', ['class' => 'panel-body']);
	echo Html::tag('div', Html::tag('div', $model->description));
	echo Html::tag('br');
	echo Html::tag('div', 'Материалы к лекции: ');
	echo Html::ul($model->getAttachments()->all(), [
        'class' => 'list-group',
        'item' => function($attachment, $index)
        {
          	return Html::tag('li',
          	"<b>" . $attachment->name.'(.'.explode(".", $attachment->resource)[1].')'."</b>".Html::a('', '../attachment/file-force-download?id='.$attachment->id,['class' => 'glyphicon glyphicon-download-alt pull-right', 'style' => 'float: right;']), ['class' => 'list-group-item']);
        }
    ]);

    $hasAnswer2 = $stModel->getResults()->where(['idLesson' => $model->id, 'passed' => 1])->count() == 0;
    $hasAnswer1 = $stModel->getResults()->where(['idLesson' => $model->id, 'approved' => 0])->count() == 0;

    if($hasAnswer1 && $hasAnswer2 && $model->getQuestions()->all()!=null)
    {
        echo Html::a('Пройти тест', '../question/list?id='.$model->id ,['class' => 'btn btn-x btn-success', 'style' => 'float: right;']);
	}
	echo Html::endTag('div');
?>
</div>
</div>