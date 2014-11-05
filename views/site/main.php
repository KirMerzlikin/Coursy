
<?php
use yii\helpers\Html;?>

<center><div class="smallpanel clearfix"> <?=Html::img('images/placeit.jpg',['style'=>'width: 135px; height: 135px; float:left; margin: 10px 10px 10px 10px; src: images/placeit.jpg;']);?>
<div style="text-align: center;  font-weight: bold; font-size: 14px; color:#1e2349;"><div style="font-size:24px">Добро пожаловать на наш веб-портал!</div> <br />
У нас есть курсы с различной информацией, которые помогают людям получать новые знания.<br><br />
Присоединяйся к нам и улучши свои знания с Coursey.</div>
<br><?php echo Html::a("Войти", Yii::$app->request->BaseUrl."/site/login",
['class' => 'btn btn-primary btn-block', 'style' => 'margin-bottom: 5px; width: 400px;']);?>
<?php echo Html::a("Зарегистрироваться", Yii::$app->request->BaseUrl.'/site/registration',
['class'=> 'btn btn-x btn-default', 'style' => 'width: 400px;']); ?>
</div>
</div></center>