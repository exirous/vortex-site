<div>
	
 <table class="character_list">
    <thead>
        <tr>
            <th class="character_image"></th>
            <th>Персонаж</th>
            <th>Класс</th>
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
        <td> <span class="<?php echo $character['class']; ?>">
            <?php echo $character['name']?> 
            </span>
        </td>
        <td> <?php echo $character['class']?></td>
        <td class="rank_<?php echo $character['rank']?>"> <?php echo $character['rank']?></td>
        <td> <?php echo $character['achievement_points']?></td>
    </tr>
<?php } ?>
    </tbody>

</table>
    
</div>