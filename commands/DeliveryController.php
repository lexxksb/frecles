<?php

namespace app\commands;

use app\models\News;
use yii\console\Controller;
use Yii;

/**
 * Рассылка
 * @package app\commands
 */
class DeliveryController extends Controller{

    /**
     * @param bool $inMail
     * @param bool $inSms
     */
    public function actionIndex($inMail = true, $inSms = true){

        $users = Yii::$app->params["users"];

        if($inMail){

            $news = News::find()
                ->where(['email' => 1])
                ->andWhere(["sentEmail" => 0])
                ->all();

            foreach ($news as $_news) {
                foreach($users as $user){
                    Yii::$app->mailer->compose('news', ["news" => $_news])
                        ->setFrom(Yii::$app->params["adminEmail"])
                        ->setTo($user["email"])
                        ->setSubject("На сайте группы 'Веснушки' есть новое событие")
                        ->send();
                }
                $_news->sentEmail = 1;
                $_news->save();
            }

        }

        if($inSms){

        }

    }
}
