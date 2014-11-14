<?php

/* @var $field \app\modules\extendedrights\models\UserFields */

use yii\helpers\Html;

echo $this->render('/default/_navigation', []);
?>
<h1>Profilfeld anlegen</h1>
<?= HTML::beginForm(['create']) ?>

<?= $this->render('_form', [
	'field'=>$field,
])?>

<?= HTML::button('Speichern', ['type'=>'submit', 'class'=>'btn btn-success']) ?>
<?= HTML::endForm() ?>