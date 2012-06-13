<?php

/**
 * User: Русинов Максим
 * Date: 10.06.12
 * Time: 12:36
 */
class RaidEvent extends CActiveRecord {
    const RAID_PARTICIPATION_NORMAL = 0;
    const RAID_PARTICIPATION_LATE = 1;
    const RAID_PARTICIPATION_NO = 2;

    public static function getParticipationState($state) {
        switch ($state) {
            case self::RAID_PARTICIPATION_NORMAL:
                return '';
            case self::RAID_PARTICIPATION_LATE:
                return 'Опоздает';
            case self::RAID_PARTICIPATION_NO:
                return 'Не будет в рейде';
        }
    }
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName() {
        return 'raid_events';
    }

    public function relations() {
        return array(
            'raidSchedule' => array(self::BELONGS_TO, 'RaidSchedule', 'raid_schedule_id'),
        );
    }

    public function getParticipants($guild_id = null){
        if ($this->is_fixed) return $this->getFixedParticipations();
        if (!$guild_id) $guild_id = Yii::app()->properties->guild_id;
        $attributes = array('guild_id' => $guild_id);
        if ($this->raidSchedule) {
            $ranks_list = $this->raidSchedule->raidRanks;
            $attributes['rank_id'] = array_map(function ($rank) {return $rank->id;}, $ranks_list);
        }
        $participants = Character::model()->findAllByAttributes($attributes);

        $raid_participants = $this->getFixedParticipations();
        $already_fixed = array_map(function ($raid_participation) {return $raid_participation->character->id;}, $raid_participants);

        foreach ($participants as $participant) {
            if (in_array($participant->id, $already_fixed)) continue;
            $raid_participant = new RaidParticipation();
            $raid_participant->character_id = $participant->id;
            $raid_participant->raid_event_id = $this->id;
            $raid_participant->raid_participation_state = RaidEvent::RAID_PARTICIPATION_NORMAL;
            $raid_participants[] = $raid_participant;
        }

        return $raid_participants;
    }

    public function getFixedParticipations(){
        return RaidParticipation::model()->findAllByAttributes(array('raid_event_id' => $this->id));
    }

    protected function afterFind(){
        parent::afterFind();
        if (is_null($this->id) || ($this->is_fixed) || ($this->event_datetime > MySQL::timestampToMySqlString(time()))) return true;
        $fixedParticipants = $this->getFixedParticipations();
        $already_fixed = array_map(function ($raid_participation) {return $raid_participation->character->id;}, $fixedParticipants);
        $participants = $this->getParticipants();
        foreach ($participants as $raid_participation) {
            if (in_array($raid_participation->character_id, $already_fixed)) continue;
            $raid_participation->save();
        }
        $this->is_fixed = true;
        $this->save();
        return true;
    }

    public function setCharacterState($character, $state) {
        $sql = "REPLACE INTO raid_event_participations (raid_event_id, character_id, raid_participation_state) VALUES (:raid_event_id, :character_id, :state)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(":raid_event_id", $this->id, PDO::PARAM_INT);
        $command->bindValue(":character_id", $character->id, PDO::PARAM_INT);
        $command->bindValue(":state", $state, PDO::PARAM_INT);
        return $command->execute() > 0 ? true : false;
    }

    public function getCharacterState($character) {
        $sql = "SELECT raid_participation_state FROM raid_event_participations WHERE raid_event_id = :raid_event_id AND character_id = :character_id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(":raid_event_id", $this->id, PDO::PARAM_INT);
        $command->bindValue(":character_id", $character->id, PDO::PARAM_INT);
        return $command->queryScalar();
    }

}