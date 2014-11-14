<?php
use allatnet\yii2\modules\extendedrights\models\UserValues;

/* @var $user common\models\User */
/** @var $fields Array */

use yii\helpers\Html;

?>

	<div class="form-group">
		<?= HTML::label('E-Mail') ?>
		<?= HTML::textInput('email', $user->email) ?>
	</div>

	<div class="form-group">
		<?= HTML::label('Benutzername') ?>
		<?= HTML::textInput('username', $user->username) ?>
	</div>

	<div class="form-group">
		<?= HTML::label('Passwort') ?>
		<?= HTML::textInput('password', ((!empty($user->password_hash)) ? '*****' : '')) ?>
	</div>

<?php
if (count($fields) > 0) {
	foreach ($fields as $field) {
		$profileValue = '';
		$userValue = UserValues::findOne(['idField'=>$field['id'], 'idUser'=>[$user->id]]);
		if($userValue !== null) {
			$profileValue = $userValue->fieldValue;
		}
		?>
		<div class="form-group">
			<?= HTML::label($field['title']) ?>
			<?= HTML::textInput('UserFields['.$field['id'].']', $profileValue) ?>
		</div>
	<?php
	}

}
?>