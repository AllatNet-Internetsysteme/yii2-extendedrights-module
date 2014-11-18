<?php
use yii\helpers\Html;

echo $this->render('/default/_navigation', []);

?>
	<h1>Berechtigungen verwalten</h1>
<?= Html::a('Berechtigungen generieren', ['generate'], ['class' => 'btn btn-primary']) ?>&nbsp;
<?= Html::a('Berechtigungen erstellen', ['create'], ['class' => 'btn btn-primary']) ?>
<br />
<br />
<table class="table table-striped">
	<?php
	foreach ($permissions as $permission) {
		?>
		<tr>
			<td>
				<?= $permission->name ?>
			</td>
			<td>
				<?= $permission->description ?>
			</td>
			<td style="width: 100px;">
				<?php
				echo HTML::a('<i class="glyphicon glyphicon-pencil"></i>', ['update', 'id'=>$permission->name]).'&nbsp;-&nbsp;';
				echo HTML::a('<i class="glyphicon glyphicon-trash"></i>', ['delete', 'id'=>$permission->name], ['onclick'=>'return confirm("Löschen?")']);
				?>
			</td>
		</tr>
	<?php
	}

	?>
</table>