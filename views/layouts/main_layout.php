<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
 $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="utf-8" />
<title>Coursey | Coming Soon to a Browser Near You</title>
<link rel="stylesheet" type="text/css" href="../css/main_site.css" />
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js'></script>
<script type="text/javascript">

</script>
<!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php NavBar::begin();
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
NavBar::end();?>?>
<div class="wrapper">
<div width="500px"><img src="../images/logo.png" alt="Coursey" title="Coursey"/></div>
<?= $content ?>
</div>
<p class="credit" align="center">Copyright by Khnure Students. 2014<br></p>
</body>
</html>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>