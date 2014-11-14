<?php

namespace allatnet\yii2\modules\extendedrights\controllers;

use allatnet\yii2\modules\extendedrights\models\User;
use yii\filters\auth\AuthMethod;
use yii\web\Controller;

class AssignmentController extends ERController
{

	public function beforeAction($action) {
		return parent::beforeAction($action);
	}

	public function actionIndex() {
		$authManager = \Yii::$app->authManager;

		return $this->render('index', [
			'roles'=>$authManager->getRoles(),
			'permissions'=>$authManager->getPermissions(),
			'authManager' => $authManager,
		]);
	}

	public function actionAddrolepermission($permission, $role) {
		$authManager = \Yii::$app->authManager;
		$permission = $authManager->getPermission($permission);
		$role = $authManager->getRole($role);
		$authManager->addChild($role, $permission);
		$this->redirect(['index']);
	}

	public function actionRemoverolepermission($permission, $role) {
		$authManager = \Yii::$app->authManager;
		$permission = $authManager->getPermission($permission);
		$role = $authManager->getRole($role);
		$authManager->removeChild($role, $permission);
		$this->redirect(['index']);
	}

	public function actionUser() {
		$authManager = \Yii::$app->authManager;

		return $this->render('user', [
			'users'=>User::find()->asArray()->all(),
			'roles'=>$authManager->getRoles(),
			'authManager' => $authManager,
		]);
	}

	public function actionAdduserrole($role, $user) {
		$authManager = \Yii::$app->authManager;
		$role = $authManager->getRole($role);
		$authManager->assign($role, $user);
		$this->redirect(['user']);
	}

	public function actionRemoveuserrole($role, $user) {
		$authManager = \Yii::$app->authManager;
		$role = $authManager->getRole($role);
		$authManager->revoke($role, $user);
		$this->redirect(['user']);
	}
}
