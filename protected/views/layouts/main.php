<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet/less" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/less/bootstrap.less">
	<link rel="stylesheet/less" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/less/responsive.less">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/vortex.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/javascripts/redactor/css/redactor.css">

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/javascripts/jquery.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/javascripts/less-1.3.0.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/javascripts/redactor/redactor.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/javascripts/app.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	
<div class="container">
	<a href="/"><div id="header" class="header"></div></a>
	<div class="navbar">
		<div class="navbar-inner">
			<div id="navbar-inner">
				<?php $this->widget('zii.widgets.CMenu',array(
					'htmlOptions'=>array(
						'class'=>'nav',
					),
					'items'=>array(
						array('label'=>'Форум', 'url'=>'http://forum.vortex-guild.org/index.php'),
						array('label'=>'Логи', 'url'=>'http://worldoflogs.com/guilds/99057/'),
						array('label'=>'Прогресс', 'url'=>'http://wowprogress.com/guild/eu/Черный-Шрам/Вортекс/rating.tier13_25'),
						array('label'=>'Авторизация', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
						array('label'=>'Выйти ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
					),  
				)); ?>
			</div>
		</div>
	</div>		

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'htmlOptions' => array(
				'class' => 'breadcrumb',
			),
			'links'=>$this->breadcrumbs,
		)); ?>
	<?php endif?>

	<div class="row">

		<?php echo $content; ?>


	</div>
	<div class="row">

		<div id="footer">
			Copyright &copy; <?php echo date('Y'); ?> Rusinov Maxim.<br/>
		</div>

	</div>
</div>

</body>
</html>
