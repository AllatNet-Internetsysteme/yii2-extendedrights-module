<?php

/* @var $user common\models\User */
/** @var $fields Array */

use yii\helpers\Html;
echo $this->render('/default/_navigation', []);

?>
<h1>Benutzer bearbeiten</h1>
<?= HTML::beginForm(['update', 'id'=>$user->id]) ?>

<?= $this->render('_form', [
	'user'=>$user,
	'fields'=>$fields,
])?>

<?= HTML::button('Speichern', ['type'=>'submit', 'class'=>'btn btn-success']) ?>
<?= HTML::endForm() ?>