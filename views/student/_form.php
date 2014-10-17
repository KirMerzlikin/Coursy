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

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'passHash')->textInput(['maxlength' => 255, 'readonly'=> true]) ?>

    <?= $form->field($model, 'idGroup')->dropDownList(ArrayHelper::map(Group::find()->all(), 'id', 'name'))?>

    <?= $form->field($model, 'active')->radioList(ArrayHelper::map([['value' => '1', 'label' => 'да'],
                                                        ['value' => '0', 'label' => 'нет']], 'value', 'label')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
