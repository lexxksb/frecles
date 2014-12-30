<?php
	//use yii\helpers\Html;
	$this->title = $news->title;
	$this->params['breadcrumbs'][] = ['label' => 'События группы "Веснушки"', 'url' => "/news/list"];
	$this->params['breadcrumbs'][] = $this->title;
?>

<?= $news->content ?>