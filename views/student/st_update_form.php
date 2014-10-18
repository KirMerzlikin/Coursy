<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Group;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">

    <?php $form = ActiveForm::begin(['method' => 'post', 'action' => 'update-st']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'password')->passwordInput()?>

    <?= $form->field($model, 'confirmation')->passwordInput()?>

    <?= $form->field($model, 'idGroup')->dropDownList(ArrayHelper::map(Group::find()->all(), 'id', 'name'))->label('Группа') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
