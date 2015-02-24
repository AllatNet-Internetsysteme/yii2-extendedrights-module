<?php

namespace allatnet\yii2\modules\extendedrights\controllers;

use allatnet\yii2\modules\extendedrights\models\UserFields;
use allatnet\yii2\modules\extendedrights\models\UserValues;
use yii\web\Controller;

class UserController extends ERController
{
	public function actionIndex()
	{
		$extendedRights = \Yii::$app->getModule('extendedrights');
		$user = new $extendedRights->userModel;
		return $this->render('index', [
			'users'=>$user::find()->asArray()->all(),
		]);
	}

	public function actionCreate() {
		$extendedRights = \Yii::$app->getModule('extendedrights');
		$user = new $extendedRights->userModel;
		$fields = UserFields::find()->asArray()->all();
		if(isset($_POST['username'])){
			$user->username = $_POST['username'];
			$user->email = $_POST['email'];
			$user->setPassword($_POST['password']);
			$user->generateAuthKey();
			$user->save();
			if(count($_POST['UserFields']) > 0){
				foreach ($_POST['UserFields'] as $key => $postValue) {
					$value = UserValues::findOne(['idField'=>$key, 'idUser'=>$user->id]);
					if($value === null){
						$value = new UserValues();
						$value->idField = $key;
						$value->idUser = $user->id;
					}
					$value->fieldValue = $postValue;
					$value->save();
				}
			}
			$this->redirect(['index']);
		}
		return $this->render('create', [
			'user'=>$user,
			'fields'=>$fields,
		]);
	}

	public function actionUpdate($id) {
		$extendedRights = \Yii::$app->getModule('extendedrights');
		$user =  $extendedRights->userModel;
		$user = $user::findOne(['id'=>$id]);
		$fields = UserFields::find()->asArray()->all();
		if(isset($_POST['username'])){
			$user->username = $_POST['username'];
			$user->email = $_POST['email'];
			if(!empty($_POST['password']) && $_POST['password'] != '*****'){
				$user->setPassword($_POST['password']);
			}
			$user->save();
			if(count($_POST['UserFields']) > 0){
				foreach ($_POST['UserFields'] as $key => $postValue) {
					$value = UserValues::findOne(['idField'=>$key, 'idUser'=>$user->id]);
					if($value === null){
						$value = new UserValues();
						$value->idField = $key;
						$value->idUser = $user->id;
					}
					$value->fieldValue = $postValue;
					$value->save();
				}
			}
			$this->redirect(['index']);
		}
		return $this->render('update', [
			'user'=>$user,
			'fields'=>$fields,
		]);
	}

	public function actionDelete($id) {
		// Delete User Values
		$values = UserValues::findAll(['idUser'=>$id]);
		if(count($values) > 0){
			foreach ($values as $value) {
				$value->delete();
			}
		}

		// Delete User
		$extendedRights = \Yii::$app->getModule('extendedrights');
		$user = new $extendedRights->userModel;
		$user = $user::findOne(['id'=>$id]);
		$user->delete();
		$this->redirect(['index']);
	}
}
