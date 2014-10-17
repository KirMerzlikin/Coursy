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
            <?= Html::label('Забыли пароль?', 0, ['style' => "text-decoration:underline;  cursor: pointer;", 'onclick' =>"openModal()", 'class'=>'reg-message']) ?>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-sm" id='myModal' tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span></button>
        <h4 class="modal-title" id="modalLabel"></h4>
      </div>
      <div class="modal-body">
        <input class="form-control" placeholder='Email' id='email'></input>
      </div>
      <div class="modal-footer">
        <button id='sendResponseButton' type="button" class="btn btn-primary">Отправить</button>
      </div>
    </div>
  </div>
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

function recovery(email)
 {
    alert(email);
     $.ajax({
      type     :'POST',
      cache    : false,
      url  : '../site/recovery',
      data: {'email':email},
      statusCode: {
        500: function(data){alert('Error!\n'+data.responseText);},
        200: function(){$('#'+id).hide('slow');}
      }
    });
 }

function openModal()
{
   $('#modalLabel').text('Запрос на смену пароля');
   $('#email').val('');
   $('#sendResponseButton').click(function()
    {
        var email = $('#email').val();
        recovery(email);
        $('#myModal').modal('hide');
    });

    $('#myModal').modal('show');
 }
</script>