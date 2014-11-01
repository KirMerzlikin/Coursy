<?php
use yii\helpers\Html;?>
<div style="padding-top:30px;"><center><div style="text-align: center; font-size: 14px; color:#ffffff;">Welcome to our web portal!<br> 
We populate courses with different information, which will help people to get new knowledge.<br>
Join us and improve your knowledge with Coursey.</div>
<div style="margin-top:30px"><?php echo Html::a("Войдите", '../site/login', 
        ['class' => 'btn btn-primary btn-block', 'style' => 'margin-bottom: 5px; width: 400px;']);?></div>
		<div>
			<?php echo Html::a("Или зарегистрируйтесь.", '../site/registration', 
				['style' => 'font-size: 12px;width: 400px; text-decoration: underline; ']); ?>
		</div>
</center></div>