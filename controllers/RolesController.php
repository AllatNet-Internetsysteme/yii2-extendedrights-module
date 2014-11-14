<?php

namespace app\modules\extendedrights\controllers;

use yii\web\Controller;

class RolesController extends ERController
{

	public function actionIndex() {
		$authManager = \Yii::$app->authManager;

		return $this->render('index', [
			'roles'=>$authManager->getRoles(),
		]);
	}

	public function actionCreate() {
		$authManager = \Yii::$app->authManager;
		if(isset($_POST['description'])){
			$role = $authManager->createRole($_POST['name']);
			$role->description = $_POST['description'];
			$authManager->add($role);
			$this->redirect(['index']);
		}
		return $this->render('create');
	}

	public function actionUpdate($id) {
		$authManager = \Yii::$app->authManager;
		if(isset($_POST['description'])){
			$role = $authManager->getRole($id);
			$role->description = $_POST['description'];
			$authManager->update($id, $role);
			$this->redirect(['index']);
		}
		return $this->render('update', [
			'role' => $authManager->getRole($id),
		]);
	}

	public function actionDelete($id) {
		$authManager = \Yii::$app->authManager;
		$role = $authManager->getRole($id);
		$authManager->remove($role);
		$this->redirect(['index']);
	}
}
