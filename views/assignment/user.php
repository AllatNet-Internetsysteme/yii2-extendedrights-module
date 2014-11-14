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
	foreach ($users as $user) {
		?>
		<tr>
			<td>
				<?= $user['username'] ?>
			</td>
			<?php
			foreach ($roles as $role) {
				?>
				<td>
					<?php
					$childs = $authManager->getAssignments($user{'id'});
					if (isset($childs[$role->name]) && is_object($childs[$role->name])) {
						echo HTML::a("<i class='glyphicon glyphicon-ok-circle text-success' id='role-".$role->name.'-'.$user['username']."'>&nbsp;&nbsp;</i>", ['removeuserrole', 'role' => $role->name, 'user' => $user['id']]);
					}else{
						echo HTML::a("<i class='glyphicon glyphicon-ban-circle text-danger' id='role-".$role->name.'-'.$user['username']."'>&nbsp;&nbsp;</i>", ['adduserrole', 'role' => $role->name, 'user' => $user['id']]);
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