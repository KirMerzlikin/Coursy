<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;
Yii::$app->user->returnUrl = Yii::$app->request->getAbsoluteUrl();
?>
<div class="wrapper2 clearfix">
    <?php echo Html::tag('div','Курсы', ['id'=>'page_name']);
    $this->title = "Курсы"?>
    <div style="width: 26%; float:left;">
        <?=
            $this->render('menu_left', ['current' => 'courses', 'model' => $model]);
        ?>
    </div>
    <div style="position:relative; width: 73%; float:left;">
        <?php

            for($i = 0; $i < $model->getCourses()->count(); $i++)
            {
                echo Html::beginTag('div', ['class' => 'panel panel-default']);
                echo Html::tag('div', Html::tag('span', $model->getCourses()->all()[$i]->name .
                    ' (' . $model->getCourses()->all()[$i]->getLessons()->count() . ' лекц.)', ['class' => 'panel-title', 'style' => 'float:left; width:80%;']) .
                    Html::a('Редактировать', '../course/edit?id=' . $model->getCourses()->all()[$i]->id,['class' => 'btn btn-xs btn-primary', 'style' => 'float: right;margin-left: 20px;']),
                    ['class' => 'panel-heading clearfix']);
                echo Html::beginTag('div', ['class' => 'panel-body']);
                echo Html::img('h', ['style'=>'width: 75px; height: 75px; float:left; margin-right: 10px; background-image:url("http://placehold.it/75x75")']);
                echo Html::tag('div', $model->getCourses()->all()[$i]->description);
                echo Html::endTag('div');
                echo Html::endTag('div');
            }

            echo Html::a("<span class = 'glyphicon glyphicon-plus'></span> Создать курс", '../course/create',
                ['class' => 'btn btn-primary btn-block', 'style' => 'margin-bottom:15px; width:130px;']);
        ?>
    </div>
</div>
