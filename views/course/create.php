<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Course */

$this->title = 'Новый курс';
?><div class="wrapper2">
<div id="page_name">Создать курс</div>
<div class="course-create" style="width: 86%; margin-left:7%">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'is_lecturer' => $is_lecturer,
    ]) ?>

</div>
</div>
