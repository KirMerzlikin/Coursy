<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Course;
use app\models\Lesson;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Lesson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lesson-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--<?= $form->field($model, 'idCourse')->dropDownList(ArrayHelper::map(Course::find()->all(), 'id', 'name'))->label('Course')  ?>-->

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'published')->radioList(ArrayHelper::map([['value' => '1', 'label' => 'да'],
                                                        ['value' => '0', 'label' => 'нет']], 'value', 'label')) ?>
<?php
$sql = 'SELECT MAX(`lessonNumber`) AS lessonNumber FROM `lesson` WHERE `idCourse`='.$model->idCourse;
$lesson = Lesson::findBySql($sql)->one();
?>
    <?= $form->field($model, 'lessonNumber')->textInput(['value'=>$lesson->lessonNumber+1]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary') . ' pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
