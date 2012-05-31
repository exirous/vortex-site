<div class="box">
	<h2>Блоги</h2>
	<ul>
	    <li><?php echo CHtml::link('Создать новый блог',array('blog/create')); ?></li>
	    <?php 
	    	$dataProvider=new CActiveDataProvider('Blog');
	    	$this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_blogView',
		)); ?>
	</ul>
</div>