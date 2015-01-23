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
        $errorEmailSend = false;
        foreach($users as $user){
            if($user["id"] == 1000) continue;
            $_users[] = [
                'name' => $user["name"],
                'email' => $user["email"],
                'phone' => $user["phone"]
            ];
        }

        if( !empty($inMail) ){

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
                        $errorEmailSend = $res["text"] . (isset($res["data"]) ? " ".$res["data"] : "" );
                        break;
                    }

                }
                if(!$errorEmailSend){
                    $_news->sentEmail = 1;
                    $_news->save();
                }else{
                    echo "Ошибка отправки email:".PHP_EOL;
                    echo $errorEmailSend;
                    echo PHP_EOL;
                }

            }
        }

        if( !empty($inSms) ){

            $news = News::find()
                ->where(['sms' => 1])
                ->andWhere(["sentSms" => 0])
                ->all();

            foreach ($news as $_news) {

                $smsXml = '<?xml version="1.0" encoding="UTF-8"?>
                        <SMS>
                            <operations>
                                <operation>SEND</operation>
                            </operations>
                            <authentification>
                                <username>'.Yii::$app->params["smsUsername"].'</username>
                                <password>'.Yii::$app->params["smsPassword"].'</password>
                            </authentification>
                            <message>
                                <sender>Freckles</sender>
                                <text>Новое событие: '.$_news["title"].'</text>
                            </message>
                            <numbers>';
                foreach($_users as $us) {
                    $smsXml .= '<number messageID="msg'.$us["phone"].$_news["id"].'">'.$us["phone"].'</number>';
                };
                $smsXml .= '</numbers></SMS>';

                $Curl = curl_init();
                $CurlOptions = [
                    CURLOPT_URL => 'http://my.atompark.com/sms/xml.php',
                    CURLOPT_FOLLOWLOCATION => false,
                    CURLOPT_POST => true,
                    CURLOPT_HEADER => false,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CONNECTTIMEOUT => 15,
                    CURLOPT_TIMEOUT => 100,
                    CURLOPT_POSTFIELDS => ['XML' => $smsXml],
                ];
                curl_setopt_array($Curl, $CurlOptions);
                if(false === ($Result = curl_exec($Curl))) {
                    throw new Exception('Http request failed');
                }

                curl_close($Curl);

                $resXml = simplexml_load_string($Result);

                if(!empty($resXml) && (int)$resXml->status > 0){
                    $_news->sentSms = 1;
                    $_news->save();
                    echo PHP_EOL."Отправлено SMS: ".(int)$resXml->status.PHP_EOL;
                }else{
                    throw new Exception('Ошибка отправки SMS. Статус: '.(int)$resXml->status);
                }

            }

        }

    }
}