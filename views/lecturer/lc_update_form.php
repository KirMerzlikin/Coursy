<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Department;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lecturer-form">

    <?php $form = ActiveForm::begin(['method' => 'post', 'action' => 'update-lc']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'degree')->textInput()?>

    <?= $form->field($model, 'password')->passwordInput()?>

    <?= $form->field($model, 'confirmation')->passwordInput()?>

    <?= $form->field($model, 'idDepartment')->dropDownList(ArrayHelper::map(Department::find()->all(), 'id', 'name'))->label('Кафедра') ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
