
<?php
use yii\helpers\Html;?>
<center><div class="smallpanel clearfix"><div style="text-align: center; font-size: 14px; color:#1e2349;">Welcome to our web portal!<br>
We populate courses with different information, which will help people to get new knowledge.<br>
Join us and improve your knowledge with Coursey.</div>
<br><?php echo Html::a("Войти", Yii::$app->request->BaseUrl.'/site/login',
['class' => 'btn btn-primary btn-block', 'style' => 'margin-bottom: 5px; width: 400px;']);?>
<?php echo Html::a("Зарегистрироваться", Yii::$app->request->BaseUrl.'/site/registration',
['class'=> 'btn btn-x btn-default', 'style' => 'width: 400px;']); ?>
</div>
</div></center>