<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
/* @var $this \yii\web\View */
/* @var $content string */
AppAsset::register($this);
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= Html::csrfMetaTags() ?>
<title><?= Html::encode($this->title) ?></title>
<link rel="stylesheet" type="text/css" href="../css/auth_style.css" />
<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
<?php
NavBar::begin();
echo Nav::widget([
'options' => ['class' => 'navbar-nav navbar-right'],
'items' => [
['label' => 'Home', 'url' => ['/site/index']],
['label' => 'About', 'url' => ['/site/about']],
['label' => 'Contact', 'url' => ['/site/contact']],
Yii::$app->user->isGuest ?
['label' => 'Login', 'url' => ['/site/login']] :
['label' => 'Logout (' . Yii::$app->user->identity->name . ')',
'url' => ['/site/logout'],
'linkOptions' => ['data-method' => 'post']],
],
]);
NavBar::end();
?>
<div class="wrapper">
<center><img src="../images/logo.png" alt="Coursey" title="Coursey"/></center>
<?= $content ?>
</div>
</div>
<footer class="footer">
<div class="container">
<p class="credit" align="center">Copyright by Khnure Students. 2014<br></p>
</div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>