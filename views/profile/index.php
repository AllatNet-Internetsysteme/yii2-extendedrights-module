<?php
use yii\helpers\Html;

/** @var $fields Array */
?>

<?= $this->render('/default/_navigation', []) ?>
<div class="extendedrights-default-index">
	<h1>Profilfelder</h1>
	<?= Html::a('Feld erstellen', ['create'], ['class' => 'btn btn-primary']) ?>
</div>

<table class="table table-striped">
	<?php
	/** @var \app\modules\extendedrights\models\UserFields $field */
	foreach ($fields as $field) {
		?>
		<tr>
			<td>
				<?= $field['id']?>
			</td>
			<td>
				<?= $field['fieldName']?>
			</td>
			<td>
				<?php
				echo HTML::a('<i class="glyphicon glyphicon-pencil"></i>', ['update', 'id'=>$field['id']]);
				echo HTML::a('<i class="glyphicon glyphicon-trash"></i>', ['delete', 'id'=>$field['id']], ['onclick'=>'return confirm("Löschen?")']);
				?>
			</td>
		</tr>
	<?php
	}

	?>
</table>