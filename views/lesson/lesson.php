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
<?php echo Html::tag('div','Курсы', ['id'=>'page_name']);?>
<div style="width: 26%; float:left;">
<?=
    $this->render('..\student\menu_left', ['current' => 'subscriptions', 'model' => $stModel]);
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
	echo Html::tag('div', 'Материалы: ');
	echo Html::ul($model->getAttachments()->all(), [
        'class' => 'list-group',
        'item' => function($attachment, $index)
        {
          	return Html::tag('li',
          	"<b>" . $attachment->name."</b>".Html::a('', '../attachment/file-force-download?id='.$attachment->id,['class' => 'glyphicon glyphicon-download-alt pull-right', 'style' => 'float: right;']), ['class' => 'list-group-item']);
        }
    ]);	
    /*for($i = 0; $i < $model->getAttachments()->count(); $i++)
    {
	    echo Html::beginTag('div', ['class' => 'panel panel-default']); 
	    echo Html::tag('div', Html::tag('span', $model->getAttachments()->all()[$i]->name, ['class' => 'panel-title', 'style' => 'float:left; width:80%;'] ), ['class' => 'panel-heading clearfix' ]);
	    echo Html::beginTag('div', ['class' => 'panel-body']);
	    echo Html::tag('div', substr($model->getAttachments()->all()[$i]->description, 0, 601).'...');
	    echo Html::tag('br');
	    echo Html::a('Просмотреть', '../lesson/lesson?id='.$model->getAttachments()->all()[$i]->id,['class' => 'btn btn-x btn-primary', 'style' => 'float: right;']);
	    echo Html::endTag('div'); 
	    echo Html::endTag('div'); 
	}*/
	echo Html::endTag('div'); 
?>
</div>
</div>