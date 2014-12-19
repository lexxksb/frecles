<?php

namespace app\controllers;

use app\models\News;
use app\models\NewsForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use yii\data\Pagination;

class SiteController extends Controller
{
    public function behaviors()
    {
        // ? - не авторизованный
        // @ - авторизованный
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'addnews', 'edit', 'delete'],
                'rules' => [
                    [
                        'actions' => ['logout', 'addnews', 'edit', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
	{
		$query = News::find();

		$pagination = new Pagination([
			'defaultPageSize' => 10,
			'totalCount' => $query->count(),
		]);

		$news = $query->orderBy('date DESC')
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();

		return $this->render('index', [
			'news' => $news,
			'pagination' => $pagination
		]);
	}

    public function actionLogin()
    {
        if(!Yii::$app->user->isGuest){
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionAddnews(){

        $model = new NewsForm();
        if ($model->load(Yii::$app->request->post()) && $model->save(new News())) {
            return $this->goHome();
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

//    public function actionContact()
//    {
//        $model = new ContactForm();
//        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
//            Yii::$app->session->setFlash('contactFormSubmitted');
//
//            return $this->refresh();
//        } else {
//            return $this->render('contact', [
//                'model' => $model,
//            ]);
//        }
//    }

}
