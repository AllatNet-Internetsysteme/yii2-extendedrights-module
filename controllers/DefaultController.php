<?php

namespace allatnet\yii2\modules\extendedrights\controllers;

use yii\web\Controller;
use allatnet\yii2\modules\extendedrights\components\UserMigration;

class DefaultController extends ERController
{
    public function actionIndex()
    {
		$userMigration = new UserMigration();
		$userMigration->migrateUser();
        return $this->render('index');
    }
}
