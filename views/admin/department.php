<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-index">
<div class="menu">  <?php echo $this->render('_menuleft'); ?> </div>
 
 
<div class="content">
<?php  echo $this->render('_menu'); ?> 
<br /> <br />
</div>

<div class="content">
<?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <?php // echo $form->field($model, 'idDepartment') ?>

    <?php // echo $form->field($model, 'degree') ?>
    

    <div class="form-group">
        <?= Html::textInput('Add', null) ?>
        <?= Html::button('Add', ['class' => 'btn btn-default']) ?>
        <?= Html::button('Delete', ['class' => 'btn btn-default']) ?>
        <?= Html::button('Update', ['class' => 'btn btn-default']) ?>
    

    <?php ActiveForm::end(); ?>
   

   </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<br /> <br />
</div>
<div class="menu-bot">  <?php echo $this->render('/student/menu_bottom'); ?> </div>