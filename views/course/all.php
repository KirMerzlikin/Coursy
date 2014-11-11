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
    $this->render('../student/menu_left', ['current' => 'all', 'model' => $stModel]);
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
		    echo Html::beginTag('div', ['class' => 'panel panel-default', 'id' => $i ]);
		    echo Html::tag('div', Html::tag('span', $courses->all()[$i]->name.' (' . $courses->all()[$i]->getLessons()->count() . ' лекц.)', ['class' => 'panel-title', 'style' => 'float:left; width:80%;']).
		    	Html::tag('span', 'Лектор: '.$courses->all()[$i]->getIdLecturer()->one()->name, ['style' => 'float:right; width:20%;']), 
		    	['class' => 'panel-heading clearfix']);
		    echo Html::beginTag('div', ['class' => 'panel-body']);
		    $image = 'https://api.fnkr.net/testimg/75x75/cccccc/FFF/?text=No+image';
		    if ($courses->all()[$i]->image!="")
		    	$image = Yii::$app->request->BaseUrl.'/'.$courses->all()[$i]->image;
		    echo Html::img($image, ['style'=>'width: 75px; height: 75px; float:left; margin-right: 10px;']);
		    echo Html::tag('div', mb_substr($courses->all()[$i]->description, 0, 1000).'...');
		    echo Html::tag('br');
		    echo Html::a('Перейти', '../course/view-course?id=' . $courses->all()[$i]->id,['class' => 'btn btn-x btn-primary', 'style' => 'float: right;']);
		    if($stModel->getSubscriptions()->where(['idCourse' => $courses->all()[$i]->id, 'idStudent' => $stModel->id])->one() == null)
		    {
		    	echo Html::a('Подписаться', '../course/subscribe?id='.$courses->all()[$i]->id ,['class' => 'btn btn-x btn-success', 'style' => 'float: right; margin-right:10px;']);
			}
			if($stModel->getSubscriptions()->where(['idCourse' => $courses->all()[$i]->id, 'idStudent' => $stModel->id])->one() != null)
		    {
		    	if($stModel->getSubscriptions()->where(['idCourse' => $courses->all()[$i]->id, 'idStudent' => $stModel->id])->one()->active == 0)
		    	{
		    		echo Html::button('Отписаться', ['class' => 'disabled btn btn-x btn-danger', 'style' => 'float: right; margin-right:10px; padding: 6px 16px;', 'disabled']);
		    		/*echo Html::tag('div','<b><i><span style="color:grey; text-align: center; display: inline-block;padding: 8px 12px; margin-bottom: 0; vertical-align: middle;">Запрос на  подписку  находится  на рассмотрении у  лектора.</span></i></b>', ['style' => 'float:right;']);*/
		    	}
		    	else
		    	{
		    		echo Html::button('Отписаться', ['class' => 'btn btn-x btn-danger', 'style' => 'float: right; margin-right:10px; padding: 6px 16px; ', 'onclick' => 'askUnsubscribeConfirmation(\''.$stModel->getSubscriptions()->where(['idCourse' => $courses->all()[$i]->id])->one()->id.'\')']);
		    	}
			}
		    echo Html::endTag('div');
		    echo Html::endTag('div');
		}
    }
?>
</div>
</div>

<script>
function askUnsubscribeConfirmation(id)
{
    if (confirm('Вы уверены, что хотите отписаться?'))
    {
    	$.ajax({
      		type     :'POST',
      		cache    : false,
      		url  : '../course/unsubscribe',
      		data: {'id':id},
      		statusCode: {
        		500: function(data){alert('Error!\n'+data.responseText);},
      		}
    	});
    }
}

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