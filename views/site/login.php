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
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
