<?php

namespace app\modules\extendedrights\controllers;

use yii\web\ConflictHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\HttpException;

class ERController extends Controller
{

	public function behaviors($values = []) {

		return $values;
	}

	public function beforeAction($action) {
		$extendedRights = \Yii::$app->getModule('extendedrights');
		$loginUrl       = $extendedRights->params['loginUrl'];

		$allowed = true;
		if (!in_array(\Yii::$app->user->id, $extendedRights->params['superuser'])) {
			if ($this->module instanceof \yii\web\Application) {
				// Normaler controller
				if (!\Yii::$app->user->can($this->id.'.'.$action->id) && !\Yii::$app->user->can($this->id.'.*')) {
					$allowed = false;
				}
			} else {
				// Modul
				if (
					!\Yii::$app->user->can(ucfirst($this->module->id).'.'.$this->id.'.'.$action->id) &&
					!\Yii::$app->user->can(ucfirst($this->module->id).'.'.$this->id.'.*') &&
					!\Yii::$app->user->can(ucfirst($this->module->id).'.*')
				) {
					$allowed = false;
				}
			}
		}

		if ($allowed === false) {
			if (\Yii::$app->user->isGuest) {
				if (!((\Yii::$app->requestedRoute == $loginUrl) OR '/'.\Yii::$app->requestedRoute == $loginUrl)) {
					$this->redirect([$loginUrl]);
				}
			} else {
				throw new HttpException(404, 'not allowed');
			}
		}

		return parent::beforeAction($action);
	}
}
