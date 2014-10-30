<?php

use yii\bootstrap\Nav;
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\bootstrap\BootstrapPluginAsset;

BootstrapPluginAsset::register($this);

echo Nav::widget([
    'items' => [
        "<li class='left-info'><b>".$model->name.'</b><br>'.
        $model->email .'</li><hr>',

        Html::tag("li", "<a href='../student/subscriptions'><span class = 'glyphicon glyphicon-list'></span> Мои подписки</a>",
            ['class' => ($current == 'subscriptions') ? 'active' : '']),

        Html::tag("li", "<a href='../course/all'><span class = 'glyphicon glyphicon-search'></span> Все курсы</a>",
            ['class' => ($current == 'all') ? 'active' : '']),

        Html::tag("li", "<a href='../student/profile-update'><span class = 'glyphicon glyphicon-pencil'></span> Редактировать профиль</a>",
            ['class' => ($current == 'profile-update') ? 'active' : '']),

        Html::tag("li", "<a href='#stay-here' onClick='openModal()'><span class = 'glyphicon glyphicon-info-sign'></span> Обратная связь</a>"),

        Html::tag("li", "<a href='/projects/Coursey/web/site/logout' data-method='post'><span class = 'glyphicon glyphicon-log-out'></span> Выйти</a>"),
    ],
    'options' => ['class' => 'nav-pills nav-stacked',
    				 'style' => 'margin:0 20px 0 10px; padding:5px; border-radius: 4px; border:1px solid #DDDDDD; background:#fff'],
]);?>

<div class="modal fade bs-example-modal-sm" id='myModal' tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="modalLabel"></h4>
            </div>
            <div class="modal-body">
                <textarea rows=5 class="form-control" placeholder='Опишите свой вопрос или проблему' id='problem'></textarea>
            </div>
            <div class="modal-footer">
                <button id='sendMailButton' type="button" class="btn btn-primary">Отправить</button>
            </div>
        </div>
    </div>
</div>

 <script>
 function mailAdmin(email, problem)
 {
    $.ajax({
      type     :'POST',
      cache    : false,
      url  : '../student/mail-admin',
      data: {'email':email, 'problem':problem},
      statusCode: {
        500: function(data){alert('Error!\n'+data.responseText);}
      }
    });
 }

 function openModal(email)
 {
    $('#modalLabel').text('Письмо администратору');
    $('#problem').val('');

    $('#sendMailButton').click(function()
    {
        var problem = $('#problem').val();
        if(! ($.trim(problem).length == 0))
        {
            mailAdmin(email, problem);
            $('#myModal').modal('hide');
        }
    });

    $('#myModal').modal('show');
 }
 </script>

