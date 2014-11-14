<?php

namespace allatnet\yii2\modules\extendedrights\controllers;

use allatnet\yii2\modules\extendedrights\models\UserFields;
use allatnet\yii2\modules\extendedrights\models\UserValues;
use yii\web\Controller;
use common\models\User;

class UserController extends ERController
{
    public function actionIndex()
    {
        return $this->render('index', [
			'users'=>User::find()->asArray()->all(),
		]);
    }

	public function actionCreate() {
		$user = new User();
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
		$user = User::findOne(['id'=>$id]);
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
		$user = User::findOne(['id'=>$id]);
		$user->delete();
		$this->redirect(['index']);
	}
}
