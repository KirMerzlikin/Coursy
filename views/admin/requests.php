<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\Tabs;
Yii::$app->user->returnUrl = Yii::$app->request->getAbsoluteUrl();
$this->title = 'Admin panel -> Registration requests';

echo Nav::widget([
    'items' => [
        [
            'label' => 'Database',
            'url' => ['/admin/database'],
        ],
        [
            'label' => 'Registration requests',
            'options' => ['class' => 'active'],
        ],
    ],
    'options' => ['class' => 'nav-pills nav-stacked admin-menu',
    				 'style' => 'margin:20px 20px 0 0; padding:5px; border-radius: 4px; border:1px solid #DDDDDD'],
]);

echo Html::beginTag('div', ['class' => 'col-lg-9']);
echo Html::tag('div', Html::tag('center', Html::tag('h3', 'Заявки на регистрацию')));

$stProvider =  $stSearchModel->search(['StudentSearch' => ['active' => '0']]);
$lcProvider =  $lcSearchModel->search(['LecturerSearch' => ['active' => '0']]);

  echo Tabs::widget([
    'items' => [
        [
            'label' => 'Студенты',

            'content' => Html::ul($stProvider->getModels(), [
              'class' => 'list-group',
              'item' => function($student, $index)
              {
                return Html::tag('li',
                "Студент <b>" . $student->name . "</b> " . 
                "(email:" .  $student->email . ") " .
                "из группы " . $student->getIdGroup0()->one()->name .
                  Html::tag('span',
                  Html::button('Подтвердить',
                    ['class' => 'btn btn-success btn-xs', 'onClick' => 'sendResponse(\'student_'.$student->id.'\',\'' . $student->email . '\', true)']) .
                  Html::button('Отклонить',
                    ['class' => 'btn btn-danger btn-xs', 'onClick' => 'openModal(\'student_'.$student->id.'\',\'' . $student->name . '\', \'' . $student->email .'\')']), 
                  ['class' => 'pull-right']),
                ['class' => 'list-group-item']);
              }
            ]),

            'active' => true
        ],
        [
            'label' => 'Лекторы',

            'content' => Html::ul($lcProvider->getModels(), [
              'class' => 'list-group',
              'item' => function($lecturer, $index)
              {
                return Html::tag('li',
                "Лектор <b>" . $lecturer->name . "</b> " . 
                "(email:" .  $lecturer->email . ") " .
                "кафедры " . $lecturer->getIdDepartment0()->one()->name .
                  Html::tag('span',
                  Html::button('Подтвердить',
                    ['class' => 'btn btn-success btn-xs', 'onClick' => 'sendResponse(\'lecturer_'.$lecturer->id.'\',\'' . $lecturer->email . '\', true)']) .
                  Html::button('Отклонить',
                    ['class' => 'btn btn-danger btn-xs', 'onClick' => 'openModal(\'lecturer_'.$lecturer->id.'\',\'' . $lecturer->name . '\',\'' . $lecturer->email . '\')']), 
                  ['class' => 'pull-right']),
                ['class' => 'list-group-item']);
              }
            ]),
        ],
    ],
  ]);

echo Html::endTag('div');
?>

<div class="modal fade bs-example-modal-sm" id='myModal' tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="modalLabel"></h4>
      </div>
      <div class="modal-body">
        <textarea rows=5 class="form-control" placeholder='Причина отклонения' id='reason'></textarea>
      </div>
      <div class="modal-footer">
        <button id='sendResponseButton' type="button" class="btn btn-primary">Отправить</button>
      </div>
    </div>
  </div>
</div>

 <script>
 function sendResponse(id, email, response, reason)
 {
    if($.trim(reason).length == 0) 
      reason = 'Не указана';
    $.ajax({
      type     :'POST',
      cache    : false,
      url  : '../admin/handle-response',
      data: {'email':email, 'response':response, 'reason':reason},
      statusCode: {
        500: function(data){alert('Error!\n'+data.responseText);},
        200: function(){$('#'+id).hide('slow');}
      }
    });
 }
 function openModal(name, email)
 {
    $('#modalLabel').text('Кому: ' + name + " (" + email + ")");
    $('#reason').val('');

    $('#sendResponseButton').click(function()
    {
      var reason = $('#reason').text();
      sendResponse(email, false, reason);
      $('#myModal').modal('hide');
    });

    $('#myModal').modal('show');
 }
 </script>

