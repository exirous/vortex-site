<div>
	
 <table class="profile_list">
    <thead>
        <tr>
        	<th>Id</th>
        	<th>Основной персонаж</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Расположение</th>         
        </tr>
    </thead>    
    <tbody>
<?php foreach ($profiles as $profile) { ?>
    <tr>
    	<td><?php echo $profile->id; ?></td>
        <td><?php echo $profile->mainCharacter->name; ?></td>    	
        <td><?php echo $profile->realname; ?></td>
        <td><?php echo $profile->phone; ?></td>
        <td><?php echo $profile->place; ?></td>
    </tr>
<?php } ?>
    </tbody>

</table>
    
</div>