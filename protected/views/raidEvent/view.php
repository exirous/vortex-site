<?php
/**
 * User: Русинов Максим
 * Date: 13.06.12
 * Time: 17:56
 */

$title = $model->title;

$this->breadcrumbs=array(
    'Рейды',
    $title,
);

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$participants,
    'columns'=>array(
        array (
            'name' => 'character.name',
            'header' => 'Персонаж',
        ),
        array (
            'name' => 'character.rank.name',
            'header' => 'Ранг',
        ),
        array (
            'name' => 'raid_participation_state',
            'value'=>'RaidEvent::getParticipationState($data->raid_participation_state)',
            'header' => 'Состояние',
        ),
    )
));

?>