<?php

use yii\db\Schema;
use yii\db\Migration;

class m141218_101011_changeDate extends Migration
{
    public function up()
    {
        $this->alterColumn("news", "date", Schema::TYPE_DATETIME);
    }

    public function down()
    {

    }
}
