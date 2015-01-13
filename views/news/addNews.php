<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use letyii\tinymce\Tinymce;
use dosamigos\datetimepicker\DateTimePicker;
?>

<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'title') ?>

	<?= $form->field($model, 'content')->widget(Tinymce::className(),[
		'configs' => [
			'language' => "ru",
			'height' => "340",
			'plugins' => [
				"responsivefilemanager link table paste"
			],
			'toolbar1' => '| responsivefilemanager | link unlink anchor |',
			'external_plugins' => [
				'filemanager' => '/filemanager/plugin.min.js'
			],
			'external_filemanager_path' => "/filemanager/",
			'filemanager_title' => "Файловый менеджер",
			'filemanager_access_key' => 'LTP-1094Q-9B'
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

	<?php if($model->email){ ?>
		<div class="alert alert-success" role="alert">Рассылка по <b>email</b> сделана</div>
		<?= Html::hiddenInput('News[email]', "1") ?>
	<?php }else{ ?>
		<?= $form->field($model, 'email')->checkbox() ?>
	<?php } ?>

	<?php if($model->sms){ ?>
		<div class="alert alert-success" role="alert">Рассылка по <b>sms</b> сделана</div>
		<?= Html::hiddenInput('News[sms]', "1") ?>
	<?php }else{ ?>
		<?= $form->field($model, 'sms')->checkbox() ?>
	<?php }?>

	<div class="form-group">
		<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
	</div>

<?php ActiveForm::end(); ?>