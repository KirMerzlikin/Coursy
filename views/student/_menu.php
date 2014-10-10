<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;

echo Nav::widget([
    'options' => [
                            'class' => 'nav navbar-nav',],
    'items' => [
        ['label' => 'Лекторы', 'url' => ['/lecturer/admin']],
        ['label' => 'Студенты', 'url' => ['/student/admin']],
        ['label' => 'Кафедры', 'url' => ['/department/admin']],
        ['label' => 'Группы', 'url' => ['/group/admin']],
    ],
    
]); ?>


