<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;
?>
<div><center><h3 id='requests'>Заявки на регистрацию</h3></center></div>

<!--    <div class="line"></div>
   <div>Name хочет зарегестрироватся в роли  Role</div>
   <div class="line"></div>
   <div>Information about user</div>
<br></br>
   <div class="form-group">
   
        <?= Html::button('Принять', ['class' => 'btn btn-primary']) ?>
        <?= Html::button('Отклонить', ['class' => 'btn btn-primary']) ?> 
<br></br>
      <?= Html::textarea('Reason',null,['placeholder'=>'Причина'],['rows'=>'20']) ?>

<br></br>
	<div class="but-class">
        <?= Html::button('Отправить', ['class' => 'btn btn-primary']) ?></div>
</div>-->



<?php
    $stProvider =  $stSearchModel->search(['StudentSearch' => ['active' => '0']]);
    $stStr = "<ul class='list-group'>";    
    foreach($stProvider->getModels() as $index => $student)
    {
        $stStr .= "<li class='list-group-item'>Студент <b>" . $student->name  . 
        "</b> (email:" . $student->email . ") из группы ID-" . $student->idGroup . "<span class='pull-right'>" . 
        "<button class='btn btn-success btn-xs' onclick=\"sendAccept('". $student->email ."')\">Подтвердить</button>" .
         "<button class='btn btn-danger btn-xs' onclick=\"sendRefuse('". $student->email ."')\">Отклонить</button> " .
         "</span>" . "</li>" ;
    }
    $stStr .= "</ul>";

    $lcProvider =  $lcSearchModel->search(['LecturerSearch' => ['active' => '0']]);
    $lcStr = "<ul class='list-group'>";    
    foreach($lcProvider->getModels() as $index => $lecturer)
    {
        $lcStr .= "<li class='list-group-item'>Лектор <b>" . $lecturer->name  . 
        "</b> (email:" . $lecturer->email . ") с кафедры ID-" . $lecturer->idDepartment . "<span class='pull-right'>" . 
        "<button class='btn btn-success btn-xs' onclick=\"sendAccept(". $lecturer->email .")\">Подтвердить</button>" .
         "<button class='btn btn-danger btn-xs' onclick=\"sendRefuse(". $lecturer->email .")\">Отклонить</button> " .
         "</span>" . "</li>" ;
    }
    $lcStr .= "</ul>";
    echo Tabs::widget([
    'items' => [
        [
            'label' => 'Студенты',
            'content' => $stStr,
            'active' => true
        ],
        [
            'label' => 'Лекторы',
            'content' => $lcStr,
        ],
    ],
]);
 ?>

 <script>
 function sendAccept(email)
 {
    $.ajax({
    type     :'POST',
    cache    : false,
    url  : '../admin/accept',
    data: {'email':email}
    });
 }
 function sendRefuse(email)
 {
    $.ajax({
    type     :'POST',
    cache    : false,
    url  : '../admin/refuse',
    data: {'email':email}
    });
 }
 
 </script>