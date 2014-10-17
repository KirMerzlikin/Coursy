<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Group;
use yii\helpers\ArrayHelper;
use app\models\Lecturer;

/* @var $this yii\web\View */
/* @var $model app\models\Course */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

	<?php if($is_lecturer)
			echo Html::activeHiddenInput($model, 'idLecturer');
		else
			echo $form->field($model, 'idLecturer')->dropDownList(ArrayHelper::map(Lecturer::find()->all(), 'id', 'name'))	
	?>    

   	<?= $form->field($model, 'published')->radioList(ArrayHelper::map([['value' => '1', 'label' => 'да'],
    													['value' => '0', 'label' => 'нет']], 'value', 'label')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
