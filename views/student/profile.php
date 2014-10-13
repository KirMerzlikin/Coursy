<?php use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Group;
use yii\helpers\ArrayHelper;
?>

   
    
  <div class="wrapper2"><center>
                
                <div> 
                <?php $form = ActiveForm::begin([
                    
                   // 'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "<div class=\"col-lg-12\">{input}{error}</div>\n"
                    ],
                ]); ?>
                <table>
                <tr><td><p>Ваше имя:</p></td><td><?= $form->field($model, 'name')->textInput()?></td></tr>
                <tr><td><p>Ваш E-mail:</p></td><td><?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?></td></tr>
                <tr><td><p>Пароль:</p></td><td><?= $form->field($model, 'password')->passwordInput()?></td></tr>
                <tr><td><p>Повторите пароль:</p></td><td><?= $form->field($model, 'confirmation')->passwordInput()?></td></tr>
                <tr><td><p>Группа</p></td><td><?= $form->field($model, 'idGroup')->dropDownList(ArrayHelper::map(Group::find()->all(), 'id', 'name'))->label('Group') ?></td></tr>
                <tr><td><p>Active:</p></td><td><?= $form->field($model, 'active')->textInput()?></td></tr>
                </table>
               
                
                <table>

                
                <br><br>
                <input type="submit" name="Submit" value="Создать" class="action-button"/>
                <br><br>

     <?php ActiveForm::end(); ?>