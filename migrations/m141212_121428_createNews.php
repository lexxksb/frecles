<?php

use yii\db\Schema;
use yii\db\Migration;

class m141212_121428_createNews extends Migration
{
    public function up()
    {
		$this->createTable("news", [
			"id" => Schema::TYPE_PK,
			"title" => Schema::TYPE_STRING . ' NOT NULL',
			"content" => Schema::TYPE_TEXT,
			"date" => Schema::TYPE_DATE
		]);
    }

    public function down()
    {
        $this->dropTable("news");
    }
}
