<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Attachment;
use app\models\Question;

?>
<div class="wrapper2 clearfix">
    <?php echo Html::tag('div','Лекции', ['id'=>'page_name']);
    $this->title = "Лекция\"" . $lsModel->name ."\""?>
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
                    'model' => $lsModel
                ]) ?>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><b>Материалы к лекции</b></div>
            <div class="panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProviderAttachment,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'name',
                        'resource',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{delete}',
                            'urlCreator' => function ($action, $lsModel, $key, $index) {
                                $params = is_array($key) ? $key : ['id' => (string) $key];
                                $params[0] = '/attachment' . '/' . $action;

                                return Url::toRoute($params);
                            }
                        ],
                    ],
                ]); ?>

                <?php
                $model = new Attachment();
                $model->idLesson = $lsModel->id; 
                $form = ActiveForm::begin(['action' => ['attachment/create?id=' . $lsModel->id],
                    'options' => ['enctype'=>'multipart/form-data']]);
                echo Html::activeHiddenInput($model, 'idLesson');
                echo $form->field($model, 'name')->textInput(['maxlength' => 255]);
                echo $form->field($model, 'resource')->fileInput();
                echo Html::submitButton('Добавить', ['class' => 'btn btn-primary pull-right']);
                ActiveForm::end();
                ?>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><b>Тестовые задания к лекции</b></div>
            <div class="panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProviderQuestion,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        ['attribute' => 'text', 'options' => ['class' => 'text']],
                        ['attribute' => 'answer', 'options' => ['class' => 'answer']],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {delete}',
                            'urlCreator' => function ($action, $lsModel, $key, $index) {
                                $params = is_array($key) ? $key : ['id' => (string) $key];
                                $params[0] = '/question' . '/' . $action;

                                return Url::toRoute($params);
                            }
                        ],
                    ],
                ]); ?>

                <?php
                    $qsModel = new Question();
                    $qsModel->idLesson = $lsModel->id; 
                    $form = ActiveForm::begin(['action' => ['question/create?id=' . $lsModel->id], 'options' => ['id'=>'createForm']]);
                    echo Html::activeHiddenInput($model, 'idLesson');
                    echo $form->field($qsModel, 'text')->textInput(['maxlength' => 255]);
                    echo $form->field($qsModel, 'answer')->textInput(['maxlength' => 255]);
                    echo Html::submitButton('Добавить', ['class' => 'btn btn-primary pull-right']);
                    ActiveForm::end();

                    $form = ActiveForm::begin(['action' => ['question/update?id='], 
                        'options' => ['id'=>'updateForm', 'hidden' => 'true']]);
                    echo Html::activeHiddenInput($qsModel, 'idLesson');
                    echo $form->field($qsModel, 'text')->textInput(['maxlength' => 255]);
                    echo $form->field($qsModel, 'answer')->textInput(['maxlength' => 255]);
                    echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary pull-right']);
                    ActiveForm::end();
                ?>
            </div>
        </div>
    </div>
</div>

<script>
window.onload= function()
{
    $('td>a>.glyphicon-pencil').each(function(index)
        {
            var id = $(this).parents('tr').attr('data-key');
            var text = $(this).parents('td').prev().prev().text();
            var answer = $(this).parents('td').prev().text();

            $(this).parent('a').attr('href', '#w4');
            $(this).click(function()
            {
                $('#createForm').attr('hidden', true);
                $('#updateForm').attr('hidden', false);
                var curAction = $('#updateForm').attr('action');
                var newAction = curAction.indexOf('=') == -1 ? curAction + id : curAction.split('=')[0] + "=" + id;
                $('#updateForm').attr('action', newAction);
                $("#updateForm #question-text").val(text);
                $("#updateForm #question-answer").val(answer);
            });
        });

};
</script>