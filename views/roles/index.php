<?php
use yii\helpers\Html;
use yii\grid\GridView;

echo $this->render('/default/_navigation', []);

?>
	<h1>Rollen verwalten</h1>
<?= Html::a('Rolle erstellen', ['create'], ['class' => 'btn btn-primary']) ?>
<table class="table table-striped">
	<?php
	foreach ($roles as $role) {
		?>
		<tr>
			<td>
				<?= $role->name ?>
			</td>
			<td>
				<?= $role->description ?>
			</td>
			<td>
				<?php
				echo HTML::a('<i class="glyphicon glyphicon-pencil"></i>', ['update', 'id'=>$role->name]);
				echo HTML::a('<i class="glyphicon glyphicon-trash"></i>', ['delete', 'id'=>$role->name], ['onclick'=>'return confirm("Löschen?")']);
				?>
			</td>
		</tr>
	<?php
	}

	?>
</table>