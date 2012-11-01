<div class="character_list_view" id="character_roster_<?=$data['id']?>">
    <div class="left">
        <a href="<?=$this->createUrl('character/view',array('id'=>$data['id']));?>"><span class="<?php echo $data['warcraftClass']['english_name']; ?>">
            <?php echo $data['name']?>
        </span></a>
        (<?php echo $data['warcraftClass']['name']?> -
        <span class="rank_<?php echo $data['rank']['id']?>"> <?php echo $data['rank']['name']?></span>)
        <?
        $itemSet = $data->getLastCharacterItemSet();
        $itemSet->refresh();
        if ($itemSet) {
            echo("<span>GearScore:".$itemSet->gear_score.". ItemLevel: ".$itemSet->item_level."</span>");
        }
        ?>
    </div>

    <?php
    if(Yii::app()->user->checkAccess('administrator')) {
        $form=$this->beginWidget('CActiveForm', array(
            'id'=>'character_roster_form_'.$data['id'],
            'enableAjaxValidation'=>false,
            'htmlOptions'=>array('class'=>'left'),
            'action'=>array('character/changeSpec', 'id'=>$data['id'])
        )); ?>
            <div>
                <input type="hidden" name="id" value="<? echo $data['id']?>"/>
                Основной спек:<?php echo $form->dropDownList($data,'main_spec_id', CHtml::listData(WarcraftClassSpec::model()->findAll('warcraft_class_id='.$data['warcraft_class_id']), "id", "name"), array('class'=>'input-small', 'empty'=>'Не выбран')); ?>

                Оффспек:<?php echo $form->dropDownList($data,'off_spec_id', CHtml::listData(WarcraftClassSpec::model()->findAll('warcraft_class_id='.$data['warcraft_class_id']), "id", "name"), array('class'=>'input-small', 'empty'=>'Не выбран')); ?>

                <?php
                echo CHtml::ajaxSubmitButton('Обновить', array('character/changeSpec', 'id'=>$data['id']), array(
                        'type' => 'POST',
                        'replace' => '#character_roster_'.$data['id'],
                    ),
                    array(
                        'type' => 'submit',
                        'class' => 'btn btn-primary'
                    )); ?>
            </div>

        <?php $this->endWidget();
    }
    ?>
    <div class="clear"></div>
</div>