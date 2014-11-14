<?php

namespace app\modules\extendedrights\controllers;

use yii\web\Controller;
use app\modules\extendedrights\components\UserMigration;

class DefaultController extends ERController
{
    public function actionIndex()
    {
		$userMigration = new UserMigration();
		$userMigration->migrateUser();
        return $this->render('index');
    }
}
