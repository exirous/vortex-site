<div>
	
 <table class="character_list">
    <thead>
        <tr>
            <th class="character_image"></th>
            <th>Персонаж</th>
            <th>Класс</th>
            <th>Уровень</th>
            <th>Ранг</th>
            <th>Очки достижений</th>            
        </tr>
    </thead>    
    <tbody>
<?php foreach ($characters as $character) { ?>
    <tr>
        <td class="character_image">
            <img width="42px" height="42px" src="http://eu.battle.net/static-render/eu/<?php echo $character['thumbnail']?>" ></img>
        </td>
        <td> <span class="<?php echo $character['warcraftClass']['english_name']; ?>">
            <?php echo $character['name']?> 
            </span>
        </td>
        <td> <?php echo $character['warcraftClass']['name']?></td>
        <td> <?php echo $character['level']?></td>
        <td class="rank_<?php echo $character['rank']['id']?>"> <?php echo $character['rank']['name']?></td>
        <td> <?php echo $character['achievement_points']?></td>
    </tr>
<?php } ?>
    </tbody>

</table>
    
</div>