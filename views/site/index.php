<?php
/* @var $this yii\web\View */
$this->title = 'События группы "Веснушки"';
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1>События</h1>
<?= Html::a("Добавить событие", ["/site/addnews"]) ?>
<ul>
	<?php foreach ($news as $new): ?>
		<li>
			<?= Html::encode("{$new->title})") ?>:
		</li>
	<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>
