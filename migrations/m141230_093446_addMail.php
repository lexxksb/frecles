<?php

use yii\db\Schema;
use yii\db\Migration;

class m141230_093446_addMail extends Migration
{
    public function safeUp()
    {
        $this->addColumn("news", "sendMail", Schema::TYPE_BOOLEAN." NOT NULL COMMENT  'флаг рассылки сообщений по email'");
        $this->addColumn("news", "sendSms", Schema::TYPE_BOOLEAN." NOT NULL COMMENT  'флаг рассылки сообщений по sms'");
    }

    public function safeDown()
    {
        $this->dropColumn("news", "sendMail");
        $this->dropColumn("news", "sendSms");
    }
}
