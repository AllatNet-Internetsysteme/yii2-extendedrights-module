<?php

/* @var $permission yii\rbac\Permission */
echo $this->render('/default/_navigation', []);

use yii\helpers\Html;

?>

<?= HTML::beginForm(['update', 'id'=>$role->name]) ?>

<div class="form-group">
	<?= HTML::label('Beschreibung') ?>
	<?= HTML::textInput('description', $role->description) ?>
</div>

<?= HTML::button('Speichern', ['type'=>'submit']) ?>
<?= HTML::endForm() ?>