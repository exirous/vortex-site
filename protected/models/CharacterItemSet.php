<?php

/**
 * This is the model class for table "character_item_sets".
 */
class CharacterItemSet extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'character_item_sets';
	}

	public function rules()
	{
		return array(
			array('character_id, raw_data, updated', 'required'),
			array('character_id', 'length', 'max'=>10),
			array('id, character_id, raw_data, updated', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'character' => array(self::BELONGS_TO, 'Character', 'character_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'character_id' => 'Персонаж',
			'raw_data' => 'Чистые данные от Battle.Net',
			'updated' => 'Updated',
		);
	}

    public function refresh() {
        $this->gear_score = $this->countGearScore();
        $this->item_level = round($this->gear_score/16);
        $this->save();
    }

    public function countGearScore(){
        $lastCharacterItemSet = json_decode($this->raw_data);

        $slots = array();
        foreach ($lastCharacterItemSet as $item_key => $item) {
            if (!(($item_key == 'averageItemLevel') or ($item_key == 'averageItemLevelEquipped') or ($item_key == 'shirt'))) {
                $slots[] = $item_key;
            }
        }
        $gearscore = 0;
        $mainhand = 0;
        foreach ($slots as $item_key) {
            $item = Item::getItemById($lastCharacterItemSet->$item_key->id);
            if ($item_key == 'mainHand') {
                $item_info = json_decode($item->raw_data);
                switch ($item_info->itemSubClass){
                    case 18:
                    case 17:
                    case 20:
                    case 3:
                    case 2:
                    case 1:
                    case 6:
                    case 5:
                    case 11:
                    case 10:
                    case 9:
                    case 8:
                        $gearscore += 2*$item->item_level;
                        $mainhand = $item->item_level;
                        break;
                    default:
                        $gearscore += $item->item_level;
                }
            } elseif ($item_key == 'offHand') {
                $gearscore += ($item->item_level - $mainhand);
            } else {
                $gearscore += $item->item_level;
            }
        }
        return $gearscore;
    }

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('character_id',$this->character_id,true);
		$criteria->compare('raw_data',$this->raw_data,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}