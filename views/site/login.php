<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Авторизация';
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-12\">{input}{error}</div>\n"
        ],
    ]); ?>

    <?= $form->field($model, 'email')->textInput(['placeholder'=>'Ваш email'])?>

    <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Ваш пароль']) ?>

    <div class="form-group">
        <div class="col-lg-12">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary btn-block btn-lg', 'name' => 'login-button']) ?>
            <?= Html::label('Забыли пароль?', 0, ['style' => "text-decoration:underline;  cursor: pointer;", 'onclick' =>"unhide()", 'class'=>'reg-message']) ?>
        </div>
    </div>      


     <?php ActiveForm::end(); ?>
     <?php $form = ActiveForm::begin([
        'action' => 'recovery',
        'id' => 'recovery-form',
        'options' => ['visibility' => 'hidden', 'class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-12\">{input}{error}</div>\n",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
    <div id="hidden-div" style="visibility:hidden;">
        <?= Html::label('Введите свой email для получения нового пароля!', 0, ['class'=>'reg-message']) ?>
        <?= $form->field($model, 'email') ?>

        <div class="form-group">
            <div class=" col-lg-12">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-block btn-lg btn- btn-primary', 'name' => 'recovery-button']) ?>
            </div>
        </div>
    </div>        
     <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
function unhide()
{
    var el = document.getElementById("hidden-div");
    if(el.style.visibility == 'hidden')
    {
        el.style.visibility = 'visible';
    }
    else
    {
        el.style.visibility = 'hidden';
    }
}
</script>