<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lightbox.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/javascripts/redactor/css/redactor.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/vortex.css">
	

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/javascripts/jquery.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/javascripts/bootstrap.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/javascripts/redactor/redactor.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/javascripts/lightbox.js"></script>	
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/javascripts/app.js"></script>

    <script type="text/javascript" src="http://static.wowhead.com/widgets/power.js"></script>
    <script>var wowhead_tooltips = { "colorlinks": true, "iconizelinks": true, "renamelinks": true }</script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body data-spy="scroll">
	
<div class="container">
    <?php if (!Yii::app()->user->isGuest) {?>
    <dl id="profile_info" class="right">
        <dt>E-mail</dt>
        <dd><?php echo Yii::app()->user->name; ?></dd>
        <dt>Персонаж</dt>
        <dd><?php echo Yii::app()->user->getProfile()->mainCharacter->name; ?></dd>
        <dt>Ранг</dt>
        <dd><?php echo Yii::app()->user->getProfile()->mainCharacter->rank->name; ?></dd>
        <dt>Уровень доступа</dt>
        <dd> <?php echo Yii::app()->authManager->getAuthItem(Yii::app()->user->getRole())->getDescription(); ?></dd>

    </dl>
    <?php } ?>
	<a href="/">
        <div id="header" class="header">

        </div>
    </a>
    <div class="clear"></div>
	<div class="navbar navbar-inverse">
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
                        array('label'=>'Стримы', 'url'=>array('/stream')),
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
