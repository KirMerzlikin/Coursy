<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Department;
use app\models\Group;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\RegistrationForm */

$this->title = 'Регистрация';
?>


<div class="wrapper2"><div id="page_name">Registration</div><center>

     <div class="site-login" style='margin-top:70px'>
     <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-7\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-5 control-label'],
        ],
    ]); ?>
        
  
            <?= $form->field($model, 'name')->textInput()?>
            <?= $form->field($model, 'second_name')->textInput()?>
            <?= $form->field($model, 'email')->textInput()?>
            <?= $form->field($model, 'password')->passwordInput()?>
            <?= $form->field($model, 'confirmation')->passwordInput()?>
            
          <!--   <?= $form->field($model, 'role')->radioList(ArrayHelper::map([['value' => 'lecturer', 'label' => 'лектор',['name'=>'RegistrationForm[role]', 'required'=>'required', 'onclick'=>'show(lecturer, student)', 'id'=>'lecturer_role']],
                                                        ['value' => 'student', 'label' => 'студент','onclick'=>'show(lecturer, student)']], 'value', 'label'),['name'=>'RegistrationForm[role]']) ?>
           
       -->
        <?=Html::label('Кем Вы <br>хотите быть?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;','',['style'=>'align:left'])?>
         <input id="lecturer_role" type="radio" name="RegistrationForm[role]"  value="lecturer" onclick="show('lecturer', 'student')"/> <?=Html::label('лектор')?>
            <input id="student_role" type="radio" name="RegistrationForm[role]" value="student" onclick="show('student', 'lecturer')"/>  <?=Html::label('студент')?>
           
        
        <div id="lecturer" style="display:none;">
     
                     <?= $form->field($model, 'degree')->textInput()?>
                                  
                      <?= $form->field($model, 'department')->dropDownList(ArrayHelper::map(Department::find()->all(), 'id', 'name'))->label('Кафедра') ?>
              
        </div>
        <div id="student" style="display:none;">
        
                 <?= $form->field($model, 'group')->dropDownList(ArrayHelper::map(Group::find()->all(), 'id', 'name'))?>
            
        </div>
       
        <br><br>
     
       <?= Html::submitButton('Зарегистрироваться', ['class' => 'action-button', 'name' => 'Submit']) ?>
        <?php ActiveForm::end(); ?>
        <br><br>
    </div>
    </center>
</div>
<script>
$(document).ready(function(){
$('#<?=$model->role?>_role').click();
$('#lecturer_department').val('<?=$model->department?>');
$('#student_group').val('<?=$model->group?>');
    });

function show(id, id2)
{
    if (document.getElementById(id).style.display == 'none')
    {
        document.getElementById(id).style.display = 'block';
        document.getElementById(id2).style.display = 'none';
    }
}
</script>