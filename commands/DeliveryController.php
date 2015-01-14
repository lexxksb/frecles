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

        if($inMail){

            $news = News::findAll(["email" => 1]);

            Yii::$app->mailer->compose('news')
                ->setFrom(Yii::$app->params["adminEmail"])
                ->setTo("lexxksb@gmail.com")
                ->setSubject("Это текст")
                ->send();


        }

        if($inSms){

        }

    }
}
