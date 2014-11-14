<?php
use yii\helpers\Html;
use yii\grid\GridView;

echo $this->render('/default/_navigation', []);

?>
	<h1>Berechtigungen zuweisen</h1>
<table class="table table-striped">
		<tr>
			<td>&nbsp;
			</td>
			<?php
			foreach ($roles as $role) {
				?>
				<td>
					<?= $role->name ?>
				</td>
			<?php
			}

			?>
		</tr>
	<?php
	foreach ($permissions as $permission) {
		?>
		<tr>
			<td>
				<?= $permission->name ?>
			</td>
			<?php
			foreach ($roles as $role) {
				?>
				<td>
					<?php
					$permissionID = str_replace('*', '', $permission->name);
					$permissionID = str_replace('.', '', $permissionID);
					$childs = $authManager->getChildren($role->name);
					if(isset($childs[$permission->name]) && is_object($childs[$permission->name])){
						echo HTML::a("<i class='glyphicon glyphicon-ok-circle text-success' id='permission-".$permissionID.'-'.$role->name."'>&nbsp;&nbsp;</i>", ['removerolepermission', 'permission'=>$permission->name, 'role'=>$role->name]);
					}else{
						echo HTML::a("<i class='glyphicon glyphicon-ban-circle text-danger' id='permission-".$permissionID.'-'.$role->name."'>&nbsp;&nbsp;</i>", ['addrolepermission', 'permission'=>$permission->name, 'role'=>$role->name]);
					}
					?>
				</td>
			<?php
			}
			?>
		</tr>
	<?php
	}

	?>
</table>