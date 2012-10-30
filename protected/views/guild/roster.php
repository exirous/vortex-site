<?php
foreach ($model->guildClassLeaders as $guildClassLeader) {?>
    <h2><?=$guildClassLeader->warcraftClassRole->name?> (КЛ: <?=$guildClassLeader->character->name?>)</h2>
    <? $characters=$model->getRosterByClassRole($guildClassLeader->warcraft_class_role_id);
    $dataProvider = new CArrayDataProvider($characters,
        array(
            'pagination'=>array(
                'pageSize'=>200,
            ),
        )
    );

    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'/character/roster',
        'template'=>"{items}\n{pager}",
    ));?>

<?php } ?>
<h2>Не указан основная специализация</h2>
<? $characters=$model->getRosterByClassRole();
$dataProvider = new CArrayDataProvider($characters,
    array(
        'pagination'=>array(
            'pageSize'=>200,
        ),
    )
);

$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'/character/roster',
    'template'=>"{items}\n{pager}",
));?>