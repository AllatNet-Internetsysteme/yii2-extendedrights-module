<?php

namespace allatnet\yii2\modules\extendedrights\controllers;

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
			if(!empty($_POST['parentRole'])){
				$roleParent = $authManager->getRole($_POST['parentRole']);
				$authManager->addChild($roleParent, $role);
			}
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
			if(!empty($_POST['parentRole'])){
				$roleParent = $authManager->getRole($_POST['parentRole']);
				$authManager->addChild($roleParent, $role);
			}
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

	public function actionAddroleassignment($parentRole, $role) {
		$authManager = \Yii::$app->authManager;
		$parentRole = $authManager->getRole($parentRole);
		$role = $authManager->getRole($role);
		$authManager->addChild($parentRole, $role);
		$this->redirect(['index']);
	}

	public function actionRemoveroleassignment($parentRole, $role) {
		$authManager = \Yii::$app->authManager;
		$parentRole = $authManager->getRole($parentRole);
		$role = $authManager->getRole($role);
		$authManager->removeChild($parentRole, $role);
		$this->redirect(['index']);
	}
}
