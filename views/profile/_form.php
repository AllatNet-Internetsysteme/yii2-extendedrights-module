<?php

/* @var $field \allatnet\yii2\modules\extendedrights\components\UserFields */

use yii\helpers\Html;

?>

<div class="form-group">
	<?= HTML::label('Titel') ?>
	<?= HTML::textInput('title', $field->title) ?>
</div>

<div class="form-group">
	<?= HTML::label('Feldname') ?>
	<?= HTML::textInput('fieldName', $field->fieldName) ?>
</div>

