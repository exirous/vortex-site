<?php if ($model->step==1) {?>
<h2>Добавить персонажа</h2>

<?php $form=$this->beginWidget('MyActiveForm', array(
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
	),
	'enableClientValidation'=>true,
    'clientOptions'=>array(
        'inputContainer'=>'.control-group',
    ),
)); ?>

<?php echo $form->hiddenField($model,'step', array('value' => '1')); ?>

<?php echo $form->errorSummary($model); ?>
  	<fieldset>

        <?php $input = $form->textField($model, 'characterName'); 
  		echo $form->inputWithLabelAndError($model, 'characterName', $input); ?>


        <?php $input = $form->textField($model, 'realmName', array('value' => 'Черный Шрам'));
  		echo $form->inputWithLabelAndError($model, 'realmName', $input); ?>

	</fieldset>

 <?php echo CHtml::submitButton('Добавить', array('class' => 'btn btn-primary')); ?>
 
<?php $this->endWidget(); ?>

<?php } elseif ($model->step==2) { ?>
<h2>Подтвердить владельца персонажа</h2>
<p>В игре снимете предметы помеченнык *, после чего выйдете из игры и проверьте что персонаж обновился в Оружейной</p>

<?php 
	$slot_array = explode(',', $model->itemsForConfirm);
	echo '<h3>Имя: '.$model->characterName.'</h3>';
	echo '<h3>Игровой мир: '.$model->realmName.'</h3>';
	echo '<ul>';
	foreach ($model->characterApi->items as $item_key => $item) {
		if ($item_key == 'averageItemLevel') {
			echo '<li> Средний уровень предметов:'.$item.'</li>';
		} elseif ($item_key == 'averageItemLevelEquipped') {
			echo '<li> Средний уровень предметов:'.$item.'</li>';
		} else {
			if (in_array($item_key, $slot_array)) {
				echo '<li><strong>*'.$item_key.': '.$item->name.'</strong></li>';
			} else {
				echo '<li>'.$item_key.': '.$item->name.'</li>';
			}
		}
	}
	echo '</ul>';
?>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::activeHiddenField($model,'itemsForConfirm'); ?>
<?php echo CHtml::activeHiddenField($model,'step', array('value' => '2')); ?>

<?php echo CHtml::errorSummary($model); ?>

<?php echo CHtml::activeHiddenField($model,'characterName'); ?>

<?php echo CHtml::activeHiddenField($model, 'realmName'); ?>
 
<?php echo CHtml::submitButton('Подтвердить'); ?>
 
<?php echo CHtml::endForm(); ?>
<?php } ?>