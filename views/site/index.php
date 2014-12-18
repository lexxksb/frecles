<?php
/* @var $this yii\web\View */
$this->title = 'События группы "Веснушки"';
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1>События</h1>
<?php if(!Yii::$app->user->isGuest): ?>
	<div class="psevdoButton"><?= Html::a("Добавить событие", ["/site/addnews"]) ?></div>
<?php endif; ?>
<?php foreach ($news as $new): ?>
	<a name="#event<?= Html::encode($new->id) ?>"></a>
	<div class="media">
		<div class="media-body">
			<h2 class="media-heading"><?= Html::encode("{$new->title}") ?></h2>
			<?= Yii::$app->formatter->asDate($new->date, "long") ?> в <?= Yii::$app->formatter->asTime($new->date, "medium") ?>
			<?= $new->content ?>
		</div>
	</div>
<?php endforeach; ?>

<?= LinkPager::widget(['pagination' => $pagination]) ?>
