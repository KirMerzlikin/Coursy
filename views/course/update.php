<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Course */

$this->title = 'Изменить курс: ' . ' ' . $model->name;
?>
<div class="course-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'is_lecturer' => $is_lecturer,
    ]) ?>

</div>
