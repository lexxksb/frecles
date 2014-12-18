<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use letyii\tinymce\Tinymce;
use dosamigos\datetimepicker\DateTimePicker;
?>

<?//= Html::errorSummary($model->getErrors(), ['class' => 'errors']) ?>

<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'title') ?>

	<?= $form->field($model, 'content')->widget(Tinymce::className(),[
		'configs' => [
			'language' => "ru_RU"
		]
	]) ?>

	<?= $form->field($model, 'date')->widget(DateTimePicker::className(),[
		'language' => 'ru',
		'size' => 'ms',
		'clientOptions' => [
			'autoclose' => true,
			'format' => 'dd.mm.yyyy HH:ii',
			'todayBtn' => true
		]
	]) ?>

	<div class="form-group">
		<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
	</div>

<?php ActiveForm::end(); ?>