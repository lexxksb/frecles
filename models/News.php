<?php

namespace app\models;

use yii\db\ActiveRecord;

class News extends ActiveRecord{

	public static function tableName() {
		return 'news';
	}

	public function beforeSave($insert){

		if (parent::beforeSave($insert)) {
			if($this->date){
				$this->date = date("Y-m-d H:i:00", strtotime($this->date));
			}
			return true;
		} else {
			return false;
		}

	}

}