<?php

namespace app\modules\extendedrights\controllers;

use yii\web\Controller;

class PermissionsController extends ERController
{

	public function actionIndex() {
		$authManager = \Yii::$app->authManager;
		$authManager->getPermissions();

		return $this->render('index', [
			'permissions'=>$authManager->getPermissions(),
		]);
	}

	public function actionGenerate() {
		$authManager = \Yii::$app->authManager;

		if (isset($_POST['permissions']) && is_array($_POST['permissions'])) {
			foreach ($_POST['permissions'] as $permission => $value) {
				$permFound = $authManager->getPermission($permission);
				if(!is_object($permFound)) {
					$authPerm = $authManager->createPermission($permission);
					$authManager->add($authPerm);
				}
			}
			$this->redirect(['index']);
		}
		return $this->render('generate');
	}

	public function actionCreate() {
		$authManager = \Yii::$app->authManager;
		if(isset($_POST['name']) && isset($_POST['description'])){
			$permission = $authManager->createPermission($_POST['name']);
			$permission->description = $_POST['description'];
			$authManager->add($permission);
			$this->redirect(['index']);
		}
		return $this->render('create');
	}

	public function actionUpdate($id) {
		$authManager = \Yii::$app->authManager;
		if(isset($_POST['description'])){
			$permission = $authManager->getPermission($id);
			$permission->description = $_POST['description'];
			$authManager->update($id, $permission);
			$this->redirect(['index']);
		}
		return $this->render('update', [
			'permission' => $authManager->getPermission($id),
		]);
	}

	public function actionDelete($id) {
		$authManager = \Yii::$app->authManager;
		$permission = $authManager->getPermission($id);
		$authManager->remove($permission);
		$this->redirect(['index']);
	}
}
