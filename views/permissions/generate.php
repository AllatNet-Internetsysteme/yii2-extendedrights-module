<?php
use yii\helpers\Html;
use app\modules\extendedrights\components\Generator;

echo $this->render('/default/_navigation', []);

?>
<h1>Berechtigungen Generieren</h1>

<h3>Controllers</h3>
<?php

$authManager = \Yii::$app->authManager;
$generator = new Generator();
$controllers = $generator->getControllerActions();
$lastmodule = '';


echo Html::beginForm(['generate'])
?>
<table class="table table-striped">
	<?php
	foreach ($controllers as $controller) {
		if(count($controller['actions']) < 1)
			continue;

		// Global Extension Right
		if(!empty($controller['module'])){
			if($lastmodule != $controller['module']){
				$actionName = $controller['module'].'.*';
				$permission = $authManager->getPermission($actionName);
				if(is_object($permission)){
					?>
					<tr>
						<td style="width: 20px;"><input type="checkbox" disabled="disabled" name="permissions[<?=$actionName?>]"> </td>
						<td style="color: #888888;"><b><?= $actionName ?></b></td>
					</tr>
				<?php
				}else{
					?>
					<tr>
						<td style="width: 20px;"><input type="checkbox" name="permissions[<?=$actionName?>]"> </td>
						<td><b><?= $actionName ?></b></td>
					</tr>
				<?php
				}
				$lastmodule = $controller['module'];
			}
		}

		// Global Controller Right
		if(!empty($controller['module'])){
			$actionName = $controller['module'].'.'.$controller['name'].'.*';
		}else{
			$actionName = $controller['name'].'.*';
		}
		$permission = $authManager->getPermission($actionName);
		if(is_object($permission)){
			?>
			<tr>
				<td style="width: 20px;"><input type="checkbox" disabled="disabled" name="permissions[<?=$actionName?>]"> </td>
				<td style="color: #888888;"><b><?= $actionName ?></b></td>
			</tr>
		<?php
		}else{
			?>
			<tr>
				<td style="width: 20px;"><input type="checkbox" name="permissions[<?=$actionName?>]"> </td>
				<td><b><?= $actionName ?></b></td>
			</tr>
		<?php
		}

		// Action rights
		foreach ($controller['actions'] as $action) {
			if(!empty($controller['module'])){
				$actionName = $controller['module'].'.'.$controller['name'].'.'.$action['name'];
			}else{
				$actionName = $controller['name'].'.'.$action['name'];
			}
			$permission = $authManager->getPermission($actionName);
			if(is_object($permission)){
				?>
				<tr>
					<td style="width: 20px;"><input type="checkbox" disabled="disabled" name="permissions[<?=$actionName?>]"> </td>
					<td style="color: #888888;"><?= $actionName ?></td>
				</tr>
			<?php
			}else{
				?>
				<tr>
					<td style="width: 20px;"><input type="checkbox" name="permissions[<?=$actionName?>]"> </td>
					<td><?= $actionName ?></td>
				</tr>
			<?php
			}
		}
	}
	?>
</table>

<?php
echo Html::button('Generieren', ['type'=>'submit', 'class' => 'btn btn-primary']);
echo Html::endForm();
?>