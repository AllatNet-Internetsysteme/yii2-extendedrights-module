<?php
use yii\helpers\Html;

?>

<?= $this->render('/default/_navigation', []) ?>
<div class="extendedrights-default-index">
	<h1>Benutzer</h1>
	<?= Html::a('Benutzer erstellen', ['create'], ['class' => 'btn btn-primary']) ?>
</div>

<table class="table table-striped">
	<?php
	foreach ($users as $user) {
		?>
		<tr>
			<td>
				<?= $user['username']?>
			</td>
			<td>
				<?= $user['email']?>
			</td>
			<td>
				<?php
				echo HTML::a('<i class="glyphicon glyphicon-pencil"></i>', ['update', 'id'=>$user['id']]);
				echo HTML::a('<i class="glyphicon glyphicon-trash"></i>', ['delete', 'id'=>$user['id']], ['onclick'=>'return confirm("Löschen?")']);
				?>
			</td>
		</tr>
	<?php
	}

	?>
</table>