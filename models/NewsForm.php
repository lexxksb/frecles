<?php

namespace app\models;

use yii\base\Model;

class NewsForm extends Model{

	public $title;
	public $content;
	public $date;
	public $email;
	public $sms;

	public function rules(){
		return [
			[["title", "content", "date"], "required"],
			[["email", 'sms'], 'boolean']
//			["date", 'validateDate']
		];
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

	public function validateDate($attribute, $params){
		if (!$this->hasErrors()) {

		}
		$this->addError($attribute, 'Iff error.');
	}

	public function save(News $news){

		if($this->validate()){
			$news->setAttributes($this->attributes, false);
			return $news->save();
		}
		return false;
	}


}
