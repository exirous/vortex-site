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
if(Yii::app()->user->checkAccess('administrator') && (count($this->menu) > 0)) {
    ?>
    <div class="box">
        <h2>Операции</h2>
        <div class="box_content">
            <?php
            $this->beginWidget('zii.widgets.CPortlet', array(
            ));
            $this->widget('zii.widgets.CMenu', array(
                'items'=>$this->menu,
            ));
            $this->endWidget();
            ?>
        </div>
    </div>
    <?php
}
?>

<?php 
	if(Yii::app()->user->checkAccess('administrator')){
		$this->operationMenu[] = array('label'=>'Загрузить список игровых миров', 'url'=>array('wowapi/RealmsLoad'));
		$this->operationMenu[] = array('label'=>'Загрузить гильдию Вортекс', 'url'=>array('wowapi/GuildLoad'));
		$this->operationMenu[] = array('label'=>'Обработать TeamSpeak3', 'url'=>array('site/TeamSpeakMaintance'));
        $this->operationMenu[] = array('label'=>'Заполнить список рейдов', 'url'=>array('raidSchedule/generate'));
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

<?php if(Yii::app()->user->checkAccess('member')){ ?>
<div class="box">
    <h2>Важно</h2>
    <ul>
    <div class="box_content">
        <?php
            $posts = Post::model()->findAllByAttributes(array('blog_id' => 16));
            $this->renderPartial('/post/list', array('posts' => $posts));
        ?>
    </div>
    </ul>
</div>
<?php } ?>

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

    <div class="box">
        <h2>Ближайшие рейды</h2>
        <div class="box_content">
            <?php
            $raids_events = RaidEvent::model()->findAll("event_datetime > '".MySQL::timestampToMySqlString(time())."' ORDER BY event_datetime ASC LIMIT 5");
            foreach ($raids_events as $raid_event) {
                echo CHtml::link($raid_event->title, array('raidEvent/view', 'id' => $raid_event->id)).'<br/>';
                echo Yii::app()->dateFormatter->formatDateTime($raid_event->event_datetime, 'full', 'medium').'<br/>';

                $profile = Yii::app()->user->profile;
                if ($profile && !$raid_event->is_fixed && $profile->mainCharacter) {
                    $state = $raid_event->getCharacterState($profile->mainCharacter);
                    if ($state != RaidEvent::RAID_PARTICIPATION_NORMAL)
                        echo CHtml::link('Буду', array('raidEvent/setRaidParticipationStateNormal', 'id'=>$raid_event->id), array('class' => 'btn btn-success')).'&nbsp;';
                    if ($state != RaidEvent::RAID_PARTICIPATION_LATE)
                        echo CHtml::link('Опоздаю', array('raidEvent/setRaidParticipationStateLate', 'id'=>$raid_event->id), array('class' => 'btn btn-warning')).'&nbsp;';
                    if ($state != RaidEvent::RAID_PARTICIPATION_NO)
                        echo CHtml::link('Не смогу придти', array('raidEvent/setRaidParticipationStateNo', 'id'=>$raid_event->id), array('class' => 'btn btn-danger')).'&nbsp;';
                }
                echo '<br/><br/>';
            }

            ?>
        </div>
    </div>

	<?php if (!Yii::app()->user->isGuest) {?>
	<?php 
		$this->profileMenu[] = array('label'=>'Профиль', 'url'=>array('profile/view'));
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