<?php

/* @var $permission yii\rbac\Permission */
echo $this->render('/default/_navigation', []);

use yii\helpers\Html;

?>

<div class="row">
	<div class="col-xs-12">
		<?= HTML::beginForm(['update', 'id'=>$permission->name]) ?>
		<div class="row">
			<div class="col-xs-4">
				<?= HTML::label('Beschreibung') ?>
			</div>
			<div class="col-xs-8">
				<?= HTML::textInput('description', $permission->description, ['class'=>'form-control']) ?>
			</div>
		</div>
		<?= HTML::button('Speichern', ['type'=>'submit', 'class'=>'btn btn-primary']) ?>
		<?= HTML::endForm() ?>
	</div>
</div>
