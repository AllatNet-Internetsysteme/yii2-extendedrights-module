<?php

use yii\helpers\Html;

/* @var $permission yii\rbac\Permission */
echo $this->render('/default/_navigation', []);

/** @var yii\rbac\DbManager $auth */
$auth = Yii::$app->authManager;

?>

<?= HTML::beginForm(['update', 'id' => $role->name]) ?>

	<div class="form-group">
		<?= HTML::label('Beschreibung') ?>
		<?= HTML::textInput('description', $role->description) ?>
	</div>

<?= HTML::button('Speichern', ['type' => 'submit']) ?>
<?= HTML::endForm() ?>