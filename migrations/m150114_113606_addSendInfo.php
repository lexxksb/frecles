<?php

use yii\db\Schema;
use yii\db\Migration;

class m150114_113606_addSendInfo extends Migration
{
    public function safeUp()
    {
        $this->addColumn("news", "sentEmail", Schema::TYPE_BOOLEAN." NOT NULL COMMENT  'флаг успешной рассылки по email'");
        $this->addColumn("news", "sentSms", Schema::TYPE_BOOLEAN." NOT NULL COMMENT  'флаг успешной рассылки по sms'");
    }

    public function safeDown()
    {

        $this->dropColumn("news", "sentEmail");
        $this->dropColumn("news", "sentSms");

    }
}
