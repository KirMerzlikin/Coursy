<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
?>
<div><center><h3 id='requests'>Заявки на регистрацию</h3></center></div>

<?php
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
                    ['class' => 'btn btn-success btn-xs', 'onClick' => 'sendResponse(\'' . $student->email . '\', true)']) .
                  Html::button('Отклонить',
                    ['class' => 'btn btn-danger btn-xs', 'onClick' => 'openModal(\'' . $student->name . '\', \'' . $student->email .'\')']), 
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
                    ['class' => 'btn btn-success btn-xs', 'onClick' => 'sendResponse(\'' . $lecturer->email . '\', true)']) .
                  Html::button('Отклонить',
                    ['class' => 'btn btn-danger btn-xs', 'onClick' => 'sendResponse(\'' . $lecturer->email . '\', false)']), 
                  ['class' => 'pull-right']),
                ['class' => 'list-group-item']);
              }
            ]),
        ],
    ],
  ]);
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
 function sendResponse(email, response, reason)
 {
    if($.trim(reason).length == 0) 
      reason = 'Не указана';
    $.ajax({
      type     :'POST',
      cache    : false,
      url  : '../admin/handle-response',
      data: {'email':email, 'response':response, 'reason':reason}
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