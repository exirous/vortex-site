<?php $this->beginContent('//layouts/main'); ?>
<div class="span12 main_box">
	<div id="content">
		<?php
    	foreach(Yii::app()->user->getFlashes() as $key => $message) {
        	echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    	}
    	?>		
		<?php echo $content; ?>
	</div>
</div>
<?php $this->endContent(); ?>