<?php 
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use app\models\Group;


use yii\helpers\ArrayHelper;
Yii::$app->user->returnUrl = Yii::$app->request->getAbsoluteUrl();
?>

<div class='wrapper2 clearfix'>
<?php echo Html::tag('div','Подписки', ['id'=>'page_name']);?>
<div style="width: 26%; float:left;">
<?=
    $this->render('menu_left', ['current' => 'subscriptions', 'model' => $model]);
?>
</div>

<div style="position:relative; width: 73%; float:left;">
<?php 
    for($i = 0; $i < 5; $i++)
    {
        
    }
?>
</div>
</div>
     
     

 
  

  
  
  

