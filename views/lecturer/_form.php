<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Department;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Lecturer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lecturer-form">

    <?php $form = ActiveForm::begin(); ?>    

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'passHash')->textInput(['maxlength' => 255, 'readonly'=> true]) ?>

    <?= $form->field($model, 'idDepartment')->dropDownList(ArrayHelper::map(Department::find()->all(), 'id', 'name'))->label('Department') ?>

    <?= $form->field($model, 'degree')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
