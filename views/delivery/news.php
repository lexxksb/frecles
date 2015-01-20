<?php
use yii\helpers\Html;
?>

<h2><?= Html::encode($news->title) ?></h2>

<p><a href="http://<?= Yii::$app->params["prodHost"] ?>/?r=news/view&id=<?=$news->id?>">Читать подробнее</a></p>