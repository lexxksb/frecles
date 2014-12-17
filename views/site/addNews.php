<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use letyii\tinymce\Tinymce;
?>

<?= Html::errorSummary($model->getErrors(), ['class' => 'errors']) ?>

<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'title') ?>

	<?= $form->field($model, 'content')->widget(Tinymce::className(),[
		'configs' => [
			'language' => "ru_RU"
		]
	]) ?>

	<?= $form->field($model, 'date')->widget(DatePicker::className(),[
		'dateFormat' => 'yyyy-MM-dd'
	]) ?>

	<div class="form-group">
		<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
	</div>

<?php ActiveForm::end(); ?>