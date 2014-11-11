<?php

use yii\helpers\Html;
use yii\widgets\ListView;

?>
<div class="wrapper2 clearfix">
    <?php echo Html::tag('div','Курсы', ['id'=>'page_name']);
    $this->title = "Курс\"" . $crModel->name . "\""?>
    <div style="width: 26%; float:left;">
        <?=
            $this->render('../lecturer/menu_left', ['current' => 'courses', 'model' => $lcModel]);
        ?>
    </div>

    <div style="position:relative; width: 73%; float:left;">

        <div class="panel panel-default">
            <div class="panel-heading"><b>Общая информация</b></div>
            <div class="panel-body">
                <?= $this->render('_form', [
                    'model' => $crModel,
                    'is_lecturer' => true,
                    ])
                ?>
            </div>
        </div>

        <div class="panel panel-default">
           	<div class="panel-heading"><b>Лекции курса</b></div>
            <div class="panel-body">
                <?php
                  	echo Html::ul($crModel->getLessons()->orderBy('lessonNumber')->all(), [
                        'class' => 'list-group',
                        'item' => function($lesson, $index)
                            {
                            	return Html::tag('li',
                            	"<a href = '../lesson/edit?id=" . $lesson->id . "'>Лекция #" . $lesson->lessonNumber . ": <b>\"" . $lesson->name . "\"</b></a>" . 
                            	Html::tag('span', '', ['class' => 'pull-right glyphicon glyphicon-remove', 
                            		'style' => 'cursor:pointer; color:#428BCA',
                            		'onClick' => 'deleteLesson('. $lesson->id .')']),
                            	['class' => 'list-group-item', 'id' => $lesson->id]);
                            }
                        ]);
                    echo Html::a('Создать', '../lesson/create?id=' . $crModel->id, ['class' => 'btn btn-primary pull-right']);
                ?>
            </div>
        </div>

        <script>
          	function deleteLesson(id)
          	{
          		if (confirm('Вы действительно хотите удалить данную лекцию?'))
          		{
          			$.post('../lesson/delete?id=' + id);
                $('#'+id).hide('slow');
          		}
          	}
        </script>
    </div>
</div>