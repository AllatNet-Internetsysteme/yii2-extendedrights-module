<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

echo $this->render('/default/_navigation', []);

?>
	<h1>Rollen verwalten</h1>
<?= Html::a('Rolle erstellen', ['create'], ['class' => 'btn btn-primary']) ?>
<table class="table table-striped">
	<?php
	/** @var Array $roles */
	/** @var yii\rbac\Role $role */
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
				Modal::begin([
				'header' => '<h2>Rollenzuweisung</h2>',
				'toggleButton' => ['label' => 'Rollenzuweisung'],
				]);
				?>
				<p>
					Die Rolle <?=$role->name ?> hat folgende untergeordnete Rollen:
				</p>
				<?php
				$authManager = Yii::$app->getAuthManager();
				/** @var Array $roleList */
				$roleList = $authManager->getRoles();
				?>
				<table class="table table-striped">
					<?php
					/** @var yii\rbac\Role $roleListDetail */
					foreach ($roleList as $roleListDetail) {
						if($roleListDetail->type == yii\rbac\Role::TYPE_ROLE && $role->name != $roleListDetail->name) {
							?>
							<tr>
								<td>
									<?= $roleListDetail->name ?>
								</td>
								<td>
									<?php
									/** @var Array $childs */
									$childs = $authManager->getChildren($role->name);
									if (isset($childs[$roleListDetail->name]) && is_object($childs[$roleListDetail->name])) {
										echo HTML::a("<i class='glyphicon glyphicon-ok-circle text-success' id='role-'".$role->name."'>&nbsp;&nbsp;</i>", ['removeroleassignment', 'role' => $roleListDetail->name, 'parentRole' => $role->name]);
									} else {
										echo HTML::a("<i class='glyphicon glyphicon-ban-circle text-danger' id='role-".$role->name."'>&nbsp;&nbsp;</i>", ['addroleassignment', 'role' => $roleListDetail->name, 'parentRole' => $role->name]);
									}
									?>
								</td>
							</tr>
						<?php
						}
					}
					?>
				</table>
				<?php


				Modal::end();
				?>
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