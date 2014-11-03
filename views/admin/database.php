<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\Tabs;

Yii::$app->user->returnUrl = Yii::$app->request->getAbsoluteUrl();
$this->title = 'Admin panel -> Database';

echo Nav::widget([
    'items' => [
        [
            'label' => 'База данных',
            'options' => ['class' => 'active'],
        ],
        [
            'label' => 'Запросы на регистрацию',
            'url' => ['/admin/requests'],
        ],
    ],
    'options' => ['class' => 'nav-pills nav-stacked admin-menu',
    				 'style' => 'margin:20px 20px 0 0; padding:5px; border-radius: 4px; border:1px solid #DDDDDD'],
]);

echo Html::beginTag('div', ['class' => 'col-lg-9']);
echo Html::tag('div', Html::tag('center', Html::tag('h3', 'База данных')));

echo Tabs::widget([
    'items' => [
        [
            'label' => 'Студенты',
            'content' => GridView::widget([
                'dataProvider' => $stDataProvider,
                'columns' => [
                  'id',
                  'name',
                  'email:email',
                  'passHash',
                  ['attribute' => 'idGroup', 'value' => function($data)
                    {
                        return $data->getIdGroup()->one()->name;
                    }],

                  ['class' => 'yii\grid\ActionColumn', 'urlCreator' => function($action, $model, $key, $index)
                  {
                      $params = is_array($key) ? $key : ['id' => (string) $key];
                      $params[0] = '/student' . '/' . $action;

                  return Url::toRoute($params);
                  }],
                ],
              ]),
            'active' => true
        ],
        [
            'label' => 'Лекторы',
            'content' => GridView::widget([
              'dataProvider' => $lcDataProvider,
              'columns' => [
                'id',
                'name',
                'email:email',
                'passHash',
                ['attribute' => 'idDepartment', 'value' => function($data)
                    {
                        return $data->getIdDepartment()->one()->name;
                    }],
                'degree',

                ['class' => 'yii\grid\ActionColumn', 'urlCreator' => function($action, $model, $key, $index)
                {
                    $params = is_array($key) ? $key : ['id' => (string) $key];
                    $params[0] = '/lecturer' . '/' . $action;

                return Url::toRoute($params);
                }],
              ],
            ]),
        ],
        [
            'label' => 'Группы',
            'content' => GridView::widget([
              'dataProvider' => $grDataProvider,
                'columns' => [
                  'id',
                  'name',

                  ['class' => 'yii\grid\ActionColumn', 'urlCreator' => function($action, $model, $key, $index)
                  {
                      $params = is_array($key) ? $key : ['id' => (string) $key];
                      $params[0] = '/group' . '/' . $action;

                  return Url::toRoute($params);
                  }],
                ],
              ]).Html::a('Создать',['group/create'] ,['class' => 'btn btn-primary']),
        ],
        [
            'label' => 'Кафедры',
            'content' => GridView::widget([
              'dataProvider' => $depDataProvider,
                'columns' => [
                  'id',
                  'name',

                  ['class' => 'yii\grid\ActionColumn', 'urlCreator' => function($action, $model, $key, $index)
                  {
                      $params = is_array($key) ? $key : ['id' => (string) $key];
                      $params[0] = '/department' . '/' . $action;

                  return Url::toRoute($params);
                  }],
                ],
              ]).Html::a('Создать',['department/create'] ,['class' => 'btn btn-primary']),
        ],
        [
            'label' => 'Курсы',
            'content' => GridView::widget([
              'dataProvider' => $crDataProvider,
                'columns' => [
                  'name',
                  ['attribute' => 'idLecturer',
                        'value' => function($data)
                        {
                          return $data->getIdLecturer()->one()->name;
                        }],
                  ['attribute' => 'published',  'format' => 'boolean'],

                  ['class' => 'yii\grid\ActionColumn', 'urlCreator' => function($action, $model, $key, $index)
                  {
                      $params = is_array($key) ? $key : ['id' => (string) $key];
                      $params[0] = '/course' . '/' . $action;

                  return Url::toRoute($params);
                  }],
                ],
              ]),
        ],

    ],
  ]);

echo Html::endTag('div');
?>       