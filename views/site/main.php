
<?php
use yii\helpers\Html;

$this->title = 'Coursey | Главная';?>

<center>
	<div class="smallpanel clearfix">
		<div style="text-align: center;  font-weight: bold; font-size: 14px; color:#1e2349;">
			<div style="font-size:24px">Добро пожаловать на наш веб-портал!</div> <br />
			 <?=Html::img('images/placeit.jpg',['style'=>'width: 200px; height: 150px;   src: images/placeit.jpg;']);?><br></br>
			У нас есть курсы с различной информацией, которые помогают людям получать новые знания.<br>
			Присоединяйся к нам и улучши свои знания с Coursey.
		</div>
		<br>
		<?php echo Html::a("Войти", Yii::$app->request->BaseUrl."/site/login",
		['class' => 'btn btn-primary btn-block', 'style' => 'margin-bottom: 5px; width: 400px;']);?>
		<?php echo Html::a("Зарегистрироваться", Yii::$app->request->BaseUrl.'/site/registration',
		['class'=> 'btn btn-x btn-default', 'style' => 'width: 400px;']); ?>
	</div>
</center>