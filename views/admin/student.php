<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
Yii::$app->user->returnUrl = Yii::$app->request->getAbsoluteUrl();
/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerCssFile('../css/site.css');

$this->title = 'Students';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="menu">  <?php echo $this->render('_menuleft'); ?> </div>
 
<div class="content">
<?php  echo $this->render('_menu'); ?> 
<br /> <br />
</div>

<div class="content">
<?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'post',
    ]); ?>
    

    <div class="form-group">
        <?= Html::textInput('Add', null) ?>
        <!--<?= Html::a('Add',['student/create'] ,['class' => 'btn btn-default']) ?>-->   
    </div>
    <?php ActiveForm::end(); ?>
   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'email:email',
            'passHash',
            'idGroup',
            // 'active',

            ['class' => 'yii\grid\ActionColumn', 'urlCreator' => function($action, $model, $key, $index)
            {
                $params = is_array($key) ? $key : ['id' => (string) $key];
                $params[0] = '/student' . '/' . $action;

            return Url::toRoute($params);
            }],
        ],
    ]); ?>
<br /> <br />
</div>

<div class="menu-bot">  <?php echo $this->render('menu_bottom', ['stSearchModel' => $stSearchModel,
                                                                 'lcSearchModel' => $lcSearchModel,]); ?> </div>