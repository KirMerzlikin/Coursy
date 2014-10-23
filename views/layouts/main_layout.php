<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>	
	<link rel="stylesheet" type="text/css" href="../css/main_site.css" />
	<title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<div class="wrap">
	<div class="wrapper">
		<div width="500px"><img src="../images/logo.png" alt="Coursey" title="Coursey"/></div>
		<?= $content ?>
	</div>
	<div><p class="credit" align="center">Copyright by Khnure Students. 2014<br></p></div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>