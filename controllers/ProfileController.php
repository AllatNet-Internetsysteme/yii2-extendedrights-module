<?php

namespace allatnet\yii2\modules\extendedrights\controllers;

use yii\web\Controller;
use allatnet\yii2\modules\extendedrights\models\UserFields;

class ProfileController extends ERController
{
    public function actionIndex()
    {
        return $this->render('index', [
			'fields'=>UserFields::find()->asArray()->all(),
		]);
    }

	public function actionCreate() {
		$field = new UserFields();
		if(isset($_POST['fieldName'])){
			$field->fieldName = $_POST['fieldName'];
			$field->title = $_POST['title'];
			$field->save();
			$this->redirect(['index']);
		}
		return $this->render('create', [
			'field'=>$field,
		]);
	}

	public function actionUpdate($id) {
		$field = UserFields::findOne(['id'=>$id]);
		if(isset($_POST['fieldName'])){
			$field->fieldName = $_POST['fieldName'];
			$field->title = $_POST['title'];
			$field->save();
			$this->redirect(['index']);
		}
		return $this->render('update', [
			'field'=>$field,
		]);
	}

	public function actionDelete($id) {
		$field = UserFields::findOne(['id'=>$id]);
		$field->delete();
		$this->redirect(['index']);
	}
}
