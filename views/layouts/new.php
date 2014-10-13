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
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
	<head>
		<meta charset="utf-8" />
		<title>Coursey | Coming Soon to a Browser Near You</title>		
		<link rel="stylesheet" type="text/css" href="../css/site_new.css" />
		
		<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js'></script>
		<script type="text/javascript">
		function show(id, id2) 	
    	{ 	
			if (document.getElementById(id).style.display == 'none'){
				document.getElementById(id).style.display = 'block';
				document.getElementById(id2).style.display = 'none';
			}
		}
</script> 

		<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
    <?php $this->head() ?>
	</head>
	<body>

<?php $this->beginBody() ?>
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