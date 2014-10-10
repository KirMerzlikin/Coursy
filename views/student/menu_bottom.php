<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div><center><h3>Name wants to registrate as Role</h3></center></div>
    <div class="line"></div>
   <div>Name wants to registrate as Role</div>
   <div class="line"></div>
   <div>Information about user</div>
<br></br>
   <div class="form-group">
   
        <?= Html::button('Accept', ['class' => 'btn btn-primary']) ?>
        <?= Html::button('Deny', ['class' => 'btn btn-primary']) ?> 
<br></br>
	<?= Html::textInput('Reason', null) ?>
<br></br>
	<div class="but-class">
        <?= Html::button('Send', ['class' => 'btn btn-primary']) ?></div>
</div>