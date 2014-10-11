<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $form yii\widgets\ActiveForm */
?>
<div><center><h3>Name хочет зарегестрироватся в роли Role</h3></center></div>
    <div class="line"></div>
   <div>Name хочет зарегестрироватся в роли  Role</div>
   <div class="line"></div>
   <div>Information about user</div>
<br></br>

   <div class="form-group">
   
        <?= Html::button('Принять', ['class' => 'btn btn-primary']) ?>
        <?= Html::button('Отклонить', ['class' => 'btn btn-primary']) ?> 
<br></br>
<div class="textar">
 <?= Html::textarea('Reason',null,['placeholder'=>'Причина','cols'=>'27', 'rows'=>'7']) ?></div>
     

<br></br>
	<div class="but-class">
        <?= Html::button('Отправить', ['class' => 'btn btn-primary']) ?></div>
		
</div>