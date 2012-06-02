<?php $this->beginContent('//layouts/main'); ?>
<div class="span8">
	<div class="main_box">
		<?php
    	foreach(Yii::app()->user->getFlashes() as $key => $message) {
        	echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
    	}
    	?>		
		<?php echo $content; ?>
	</div>
</div>
<div class="span4">	

<?php 
	if(Yii::app()->user->checkAccess('administrator')){
		$this->operationMenu[] = array('label'=>'Загрузить список игровых миров', 'url'=>array('wowapi/RealmsLoad'));
		$this->operationMenu[] = array('label'=>'Загрузить гильдию Вортекс', 'url'=>array('wowapi/GuildLoad'));
		$this->operationMenu[] = array('label'=>'Обработать TeamSpeak3', 'url'=>array('site/TeamSpeakMaintance'));
		$this->operationMenu[] = array('label'=>'Список профилей', 'url'=>array('profile/list'));
?>
	<div class="box">
		<h2>Администрирование</h2>
		<div class="box_content">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->operationMenu,
			));
			$this->endWidget();
		?>
		</div>
	</div>
<?php
    }
?>

<?php 
	$this->blogMenu[] = array('label'=>'Список блогов', 'url'=>array('blog/index'));
?>
	<div class="box">
		<h2>Статьи</h2>
		<div class="box_content">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->blogMenu,
			));
			$this->endWidget();
		?>
		</div>
	</div>

	<?php if (!Yii::app()->user->isGuest) {?>
	<?php 
		$this->profileMenu[] = array('label'=>'Профиль', 'url'=>array('profile/view'));
		$this->profileMenu[] = array('label'=>'Мои статьи', 'url'=>array('post/index'));
	?>	
	<div class="box">
		<h2>Профиль</h2>
		<div class="box_content">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->profileMenu,
			));
			$this->endWidget();
		?>
		</div>
	</div>
	<?php } ?>

	<?php $this->widget('TeamSpeakOnline'); ?>

	<?php $this->widget('Links'); ?>

</div>
<?php $this->endContent(); ?>