<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Lesson;

/* @var $this yii\web\View */
/* @var $model app\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form">

    <?php $form = ActiveForm::begin(); ?>

    <h3>Урок: "
    <?php 
    $lesson=Lesson::findOne($model->idLesson);
    echo Html::encode($lesson->name);
    ?>"</h3>

    <?= $form->field($model, 'text')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'answer')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
