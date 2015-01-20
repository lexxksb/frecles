<?php

namespace app\commands;

use app\models\News;
use yii\console\Controller;
use Yii;
use SmtpApi;

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
        $_users = [];
        $errorSend = false;

        if($inMail){

            foreach($users as $user){
                if($user["id"] == 1000) continue;
                $_users[] = [
                    'name' => $user["name"],
                    'email' => $user["email"]
                ];
            }

            $sPubKey = Yii::$app->params["smtpKey"];
            $oApi = new SmtpApi($sPubKey);

            $news = News::find()
                ->where(['email' => 1])
                ->andWhere(["sentEmail" => 0])
                ->all();

            foreach ($news as $_news) {

                foreach($_users as $us) {
                    $aEmail = [
                        'html' => $this->renderPartial('news', ["news" => $_news]),
                        'encoding' => 'UTF-8',
                        'subject' => "На сайте группы 'Веснушки' есть новое событие",
                        'from' => [
                            'name' => 'Сергей Каспирович',
                            'email' => 'lexxksb@gmail.com'
                        ],
                        'to' => [$us]
                    ];

                    $res = $oApi->send_email($aEmail);
                    if($res["error"]){
                        $errorSend = $res["text"];
                        break;
                    }

                }
                if(!$errorSend){
                    $_news->sentEmail = 1;
                    $_news->save();
                }else{
                    echo "Ошибка отправки email:".PHP_EOL;
                    echo $errorSend;
                    echo PHP_EOL;
                }

            }

        }

        if($inSms){

        }

    }
}
