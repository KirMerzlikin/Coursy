<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = 'Изменить профиль: ' . ' ' . $model->name;
?>
<div class="lecturer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('lc_update_form', [
        'model' => $model,
    ]) ?>

</div>
