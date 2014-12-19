<?php

namespace app\models;

use yii\base\Model;

class NewsForm extends Model{

	public $title;
	public $content;
	public $date;

	public function rules(){
		return [
			[["title", "content", "date"], "required"],
//			["date", 'validateDate']
		];
	}

	public function attributeLabels(){
		return [
			'title' => 'Заголовок',
			'content' => 'Событие',
			'date' => 'Дата'
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

			if($news->save()) {
				return true;
			}else {
				return false;
			}
		}
		return false;
	}


}
