<?php
	/* @var $this yii\web\View */
	$this->title = 'События группы "Веснушки"';
	$this->params['breadcrumbs'][] = $this->title;
	use yii\helpers\Html;
	use yii\widgets\LinkPager;
?>
<h1><?=$this->title?></h1>
<?php if(!Yii::$app->user->isGuest): ?>
	<div class="psevdoButton"><?= Html::a("Добавить событие", ["/news/add"]) ?></div>
<?php endif; ?>
<?php foreach ($news as $new): ?>
	<a name="#event<?= Html::encode($new->id) ?>"></a>
	<div class="media">
		<div class="media-body">
			<h3 class="media-heading"><?= Html::encode("{$new->title}") ?></h3>
			<?php if(!Yii::$app->user->isGuest): ?>
				<?= Html::a("Редактировать", ["/news/edit", "id" => $new->id]) ?>&nbsp;<?= Html::a("Удалить", ["/news/delete", "id" => $new->id], ['class' => 'confirmDelete']) ?>
			<?php endif; ?>
			<div class="date">
				<?= Yii::$app->formatter->asDate($new->date, "long") ?> в <span class="date"><?= Yii::$app->formatter->asTime($new->date, "short") ?></span>
			</div>
			<div class="content"><?= $new->content ?></div>
		</div>
	</div>
<?php endforeach; ?>

<?= LinkPager::widget(['pagination' => $pagination]) ?>