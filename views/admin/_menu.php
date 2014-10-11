<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;

echo Nav::widget([
    'options' => [
                            'class' => 'nav navbar-nav',],
    'items' => [
        ['label' => 'Лекторы', 'url' => ['lecturer']],
        ['label' => 'Студенты', 'url' => ['student']],
        ['label' => 'Кафедры', 'url' => ['department']],
        ['label' => 'Группы', 'url' => ['group']],
    ],
    
]); ?>


