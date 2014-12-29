<?php

namespace app\controllers;

use yii\data\Pagination;
use app\models\News;
use app\models\NewsForm;
use yii\web\Controller;
use Yii;
use yii\filters\AccessControl;

class NewsController extends Controller{

	public function behaviors()
	{
		// ? - не авторизованный
		// @ - авторизованный
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['add', 'edit', 'delete'],
				'rules' => [
					[
						'actions' => ['add', 'edit', 'delete'],
						'allow' => true,
						'roles' => ['@'],
					]
				],
			]
		];
	}


	public function actionList(){
		$query = News::find();

		$pagination = new Pagination([
			'defaultPageSize' => 10,
			'totalCount' => $query->count(),
		]);

		$news = $query->orderBy('date DESC')
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();

		return $this->render('list', [
			'news' => $news,
			'pagination' => $pagination
		]);
	}

	public function actionView($id){
		$news = News::find($id)->one();
		return $this->render('news', ['news' => $news]);
	}

	public function actionAdd(){

		$model = new NewsForm();
		if ($model->load(Yii::$app->request->post()) && $model->save(new News())) {
			return $this->goBack();
		} else {
			return $this->render('addNews', ['model' => $model]);
		}
	}

	public function actionEdit($id){

		$news = News::findOne($id);
		$model = new NewsForm();
		if ($model->load(Yii::$app->request->post(), "News") && $model->save($news)) {
			return $this->goHome();
		} else {
			return $this->render('addNews', ['model' => $news]);
		}

	}

	public function actionDelete($id){
		News::findOne($id)->delete();
		return $this->goHome();
	}

}