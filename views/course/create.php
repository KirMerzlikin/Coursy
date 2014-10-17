<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Course */

$this->title = 'Новый курс';
?>
<div class="course-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'is_lecturer' => $is_lecturer,
    ]) ?>

</div>
