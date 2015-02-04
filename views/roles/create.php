<?php

/* @var $permission yii\rbac\Permission */

use yii\helpers\Html;

echo $this->render('/default/_navigation', []);

?>

<?= HTML::beginForm(['create']) ?>

	<div class="form-group">
		<?= HTML::label('Name') ?>
		<?= HTML::textInput('name', '') ?>
	</div>

	<div class="form-group">
		<?= HTML::label('Beschreibung') ?>
		<?= HTML::textInput('description', '') ?>
	</div>

<?= HTML::button('Speichern', ['type' => 'submit']) ?>
<?= HTML::endForm() ?>