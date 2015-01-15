<?php

namespace app\models;

use yii\db\ActiveRecord;

class News extends ActiveRecord{

	public static function tableName() {
		return 'news';
	}

	public function attributeLabels(){
		return [
			'title' => 'Заголовок',
			'content' => 'Событие',
			'date' => 'Дата',
			'email' => 'Сделать рассылку по Email',
			'sms' => "Сделать рассылку по SMS"
		];
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

	public function toEmailSend(){
	}

	public function getToSend(){

		return $this->hasMany(News::className(), [])->where("sendMail == 0");

	}

}