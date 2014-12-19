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
			<?php if(!Yii::$app->user->isGuest): ?>
				<?= Html::a("Редактировать", ["/site/edit", "id" => $new->id]) ?>&nbsp;<?= Html::a("Удалить", ["/site/delete", "id" => $new->id], ['class' => 'confirmDelete']) ?>
			<?php endif; ?>
			<div>
				<?= Yii::$app->formatter->asDate($new->date, "long") ?> в <?= Yii::$app->formatter->asTime($new->date, "short") ?>
			</div>
			<?= $new->content ?>
		</div>
	</div>
<?php endforeach; ?>

<?= LinkPager::widget(['pagination' => $pagination]) ?>
