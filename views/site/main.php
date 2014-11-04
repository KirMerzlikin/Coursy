
<?php
use yii\helpers\Html;?>
<center><div class="smallpanel clearfix"><div style="text-align: center;  font-weight: bold; font-size: 14px; color:#1e2349;"><h3>Welcome to our web portal!</h3>
We populate courses with different information, which will help people to get new knowledge.<br>
Join us and improve your knowledge with Coursey.</div>
<br><?php echo Html::a("Войти", '../site/login',
['class' => 'btn btn-primary btn-block', 'style' => 'margin-bottom: 5px; width: 400px;']);?>
<?php echo Html::a("Зарегистрироваться", '../site/registration',
['class'=> 'btn btn-x btn-default', 'style' => 'width: 400px;']); ?>
</div>
</div></center>