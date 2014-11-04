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
<?php echo Html::tag('div','Курсы', ['id'=>'page_name']);
$this->title = 'Поиск по курсам'?>
<div style="width: 26%; float:left;">
<?=
    $this->render('..\student\menu_left', ['current' => 'all', 'model' => $stModel]);
?>
</div>

<div style="position:relative; width: 73%; float:left;">

<?php 

	echo Html::tag('div',
          	"<input type=\"text\" placeholder=\"Введите запрос или часть запроса...\" class=\"form-control\" id=\"search-field\" style=\"width:77%;display: inline-block; margin-right:10px;\" onchange=setLink()></input>".
          	"<a id=\"search-link\" href=\"#\" class=\"btn btn-primary glyphicon glyphicon-search\" style=\"width:20%;display: inline-block; margin-left:10px; vertical-align: top; position:relative; top:0px\" onClick=search()></a>",
          	['style' => 'margin-bottom:20px;']);
	for($i = 0; $i < count($courses->all()); $i++)
    {
    	if($courses->all()[$i]->published == 1)
    	{
		    echo Html::beginTag('div', ['class' => 'panel panel-default']);
		    echo Html::tag('div', Html::tag('span', $courses->all()[$i]->name.' (' . $courses->all()[$i]->getLessons()->count() . ' лекц.)', ['class' => 'panel-title', 'style' => 'float:left; width:80%;']).
		    	Html::tag('span', 'Лектор: '.$courses->all()[$i]->getIdLecturer()->one()->name, ['style' => 'float:right; width:20%;']), 
		    	['class' => 'panel-heading clearfix']);
		    echo Html::beginTag('div', ['class' => 'panel-body']);
		    echo Html::img('h', ['style'=>'width: 75px; height: 75px; float:left; margin-right: 10px; background-image:url("http://placehold.it/75x75")']);
		    echo Html::tag('div', mb_substr($courses->all()[$i]->description, 0, 1000).'...');
		    echo Html::tag('br');
		    echo Html::a('Перейти', '../course/view-course?id=' . $courses->all()[$i]->id,['class' => 'btn btn-x btn-primary', 'style' => 'float: right;']);
		    if($stModel->getSubscriptions()->where(['idCourse' => $courses->all()[$i]->id])->one() == null)
		    {
		    	echo Html::a('Подписаться', '../course/subscribe?id='.$courses->all()[$i]->id ,['class' => 'btn btn-x btn-success', 'style' => 'float: right; margin-right:10px;']);
			}
		    echo Html::endTag('div'); 
		    echo Html::endTag('div');
		} 
    }
?>
</div>
</div>

<script>
function search()
{
	var key = $('#search-field').val();
	$.ajax({
      type     :'GET',
      cache    : false,
      url  : '../course/search',
      data: {'key':key},
      async: false,
      statusCode: {
        500: function(data){alert('Error!\n'+data.responseText);},
        200: function(){$('#'+id).hide('slow');}
      }
    });
}
function setLink()
{
	$('#search-link').attr('href', '../course/search?key=' + $('#search-field').val());
}
</script>