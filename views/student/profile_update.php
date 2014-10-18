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

echo "<div class='wrapper2'>";
echo Nav::widget([
    'items' => [
        '<li><center><b>'.$model->name.'</b></center></li>',
        '<li class="divider"></li>',
        '<li><center>Студент</center></li>',
        '<li><center>Группа: '.$model->getGroup().'</center></li>',    
        
       [
            'label' => 'Подписки',
            'url'=>'../student/subscriptions'
        ],

        [
            'label' => 'Редактировать профиль',
            'url'=>'../student/profile-update',
            'options' => ['class' => 'active'],              
        ],
    ],
    'options' => ['class' => 'nav-pills nav-stacked admin-menu',
    				 'style' => 'margin:20px 20px 0 0; padding:5px; border-radius: 4px; border:1px solid #DDDDDD'],
]);

echo Html::beginTag('div', ['class' => 'col-lg-9']);?>
<?= $this->render('update_st', [
        'model' => $model,
    ]) ?>
</div>