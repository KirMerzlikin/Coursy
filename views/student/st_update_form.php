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

    <?php $form = ActiveForm::begin(['method' => 'post', 'action' => 'profile-update']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'idGroup')->dropDownList(ArrayHelper::map(Group::find()->all(), 'id', 'name'))->label('Группа') ?>

    <div class="form-group">
    	
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php echo Html::button('Изменить пароль', ['class' => 'btn btn-primary pull-right', 'style' => 'margin-right:10px;', 'onclick' => "openModalPassword()"]); ?>
</div>

<div class="modal fade bs-example-modal-sm" id='myModalPassword' tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  	<div class="modal-dialog">
   		<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title" id="modalLabelPassword"></h4>
      		</div>
      		<div class="modal-body" style="overflow: auto;">
        		<?php $form = ActiveForm::begin(['method' => 'post', 'action' => 'profile-update']); ?>

        		<?= $form->field($model, 'password')->passwordInput()->label('Пароль')?>

        		<?= $form->field($model, 'confirmation')->passwordInput()->label('Подтверждение пароля')?>

        		<div class="form-group">
        			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary pull-right', 'id' => 'savePasswordButton']) ?>
    			</div>

    			<?php ActiveForm::end(); ?>
      		</div>
    	</div>
  	</div>
</div>

<script>
function openModalPassword()
{
    $('#modalLabelPassword').text('Изменить пароль');

    $('#sendResponseButtonPassword').click(function()
    {
    	$('#myModalPassword').modal('hide');
    });

    $('#myModalPassword').modal('show');
}
</script>