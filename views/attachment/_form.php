<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Lesson;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Attachment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attachment-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <h3>Лекция: "
    <?php 
    $lesson=Lesson::findOne($model->idLesson);
    echo Html::encode($lesson->name);
    ?>"</h3>

    <?= Html::activeHiddenInput($model, 'idLesson')  ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'resource')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
