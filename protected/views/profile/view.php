<?php
$this->profileMenu[] = array('label'=>'Редактировать профиль', 'url'=>array('edit'));
$this->profileMenu[] = array('label'=>'Добавить персонажа', 'url'=>array('addCharacter'));
?>
<div class="box_content">
	<h2>Профиль №<?php echo $profile->id; ?> (<?php echo $username; ?>)</h2>
	<?php if ($profile->realname) { ?>
		<p>Имя: <?php echo $profile->realname; ?><br/> Мобильный телефон: <?php echo $profile->phone; ?><br/>Расположение: <?php echo $profile->place; ?><br/></p>
	<?php } else { ?>
		<p> Необходимо заполнить <?php echo CHtml::link('профиль', array('edit')); ?>  </a> 
	<?php } ?>
	<table>
		<thead><tr>
			<td>Имя персонажа</td>
			<td>Действие</td>
		</tr></thead>
		<?php if ($profile->characterCount==0) {?>
			<tr><td colspan="2">Необходимо <?php echo CHtml::link('добавить персонажа', array('addCharacter'));  ?></td></tr>
		<?php } ?>
		<?php foreach ($profile->characters as $character) { ?>
			<tr>
				<td><img width="63px" height="63px" src="http://eu.battle.net/static-render/eu/<?php echo $character->thumbnail; ?>" ></img><br/>
					<?php if ($character->main_character) { echo "<strong>".$character->name."</strong>"; }
							else { echo $character->name; }?></td>
				<td>
					<?php 
						if (!$character->main_character) {
							echo CHtml::link('Установить основным персонажем', array('setMainCharacter', 'id' => $character->id)); 
							echo '<br/>';
						} else {
							echo $character->ts3_token_link($character->ts3_normal_token, "Подключиться к TeamSpeak 3")."<br/>"; 
							echo ($character->ts3_admin_token) ? $character->ts3_token_link($character->ts3_admin_token, "Получить права администратора в TeamSpeak 3")."<br/>" : "" ;
						}
					?>
					<?php echo CHtml::link('Удалить', array('deleteCharacter', 'id' => $character->id)); ?>
				</td>
			</tr>
		<?php } ?>
	</table>
</div>