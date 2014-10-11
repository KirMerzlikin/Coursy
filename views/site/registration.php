<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Department;
use app\models\Group;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\RegistrationForm */

$this->title = 'Регистрация';
?>

<div id="page_name">Registration</div>
                <div class="wrapper2"><center>
                
                <div> 
                <?php $form = ActiveForm::begin([
                    'id' => 'registration-form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "<div class=\"col-lg-12\">{input}{error}</div>\n"
                    ],
                ]); ?>
                <table>
                <tr><td><p>Ваше имя:</p></td><td><?= $form->field($model, 'name')->textInput()?></td></tr>
                <tr><td><p>Ваша фамилия:</p></td><td><?= $form->field($model, 'second_name')->textInput()?></td></tr>
                <tr><td><p>Ваш E-mail:</p></td><td><?= $form->field($model, 'email')->textInput()?></td></tr>
                <tr><td><p>Пароль:</p></td><td><?= $form->field($model, 'password')->passwordInput()?></td></tr>
                <tr><td><p>Повторите пароль:</p></td><td><?= $form->field($model, 'confirmation')->passwordInput()?></td></tr>
                <tr><td><p>Кем Вы хотите быть?</p></td><td></td></tr>
                <tr><td></td><td><input type="radio" name="RegistrationForm[role]" required='required' value="lecturer" onclick="show('lecturer', 'student')"/> лектор 
                <input type="radio" name="RegistrationForm[role]" value="student" onclick="show('student', 'lecturer')"/> студент</td></tr>
                </table>
                <div id="lecturer" style="display:none;">
                <table>
                <tr><td><p>Ученая степень:</p></td><td><?= $form->field($model, 'degree')->textInput()?></td></tr>
                <tr><td><p>Кафедра:</p></td><td><select name="RegistrationForm[department]" class="sel">
                    <?php foreach(Department::find()->all() as $department) {?>
                    <option selected="selected" value="<?=$department->id?>"><?=$department->name;?></option>
                    <?php } ?>
                </select></td></tr></table>
                </div>
                <div id="student" style="display:none;">
                <table>

                <!--<tr><td><p>Кафедра:</p></td><td><select name="RegistrationForm[department]" class="sel">
                    <?php foreach(Department::find()->all() as $department) {?>
                    <option selected="selected" value="<?=$department->id?>"><?=$department->name;?></option>
                    <?php } ?>
                </select></td></tr>-->
                <tr><td><p>Группа:</p></td><td><select name="RegistrationForm[group]" class="sel">
                    <?php foreach(Group::find()->all() as $group) {?>
                    <option selected="selected" value="<?=$group->id?>"><?=$group->name;?></option>
                    <?php } ?>
                </select></td></tr></table>
                </div>
                <br><br>
                <input type="submit" name="Submit" value="Зарегистрироваться" class="action-button"/>

     <?php ActiveForm::end(); ?>
                </div>  </center>
                        
        </div>