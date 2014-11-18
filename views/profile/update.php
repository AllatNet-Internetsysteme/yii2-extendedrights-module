<?php

/* @var $field \allatnet\yii2\modules\extendedrights\components\UserFields */

use yii\helpers\Html;
echo $this->render('/default/_navigation', []);

?>
<h1>Profilfeld bearbeiten</h1>
<?= HTML::beginForm(['update', 'id'=>$field->id]) ?>

<?= $this->render('_form', [
	'field'=>$field,
])?>

<?= HTML::button('Speichern', ['type'=>'submit', 'class'=>'btn btn-success']) ?>
<?= HTML::endForm() ?>