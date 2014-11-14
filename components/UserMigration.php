<?php

namespace app\modules\extendedrights\components;

use yii\db\Migration;

class UserMigration extends Migration{

	/**
	 *
	 */
	public function migrateUser() {
		// Capture Output
		ob_start();

		// Check if Table exist
		$tablename = \Yii::$app->db->tablePrefix.'user_fields';
		if(\Yii::$app->db->schema->getTableSchema($tablename) === null){
			// Create table
			$this->createTable($tablename,
				[
					'id'=>'pk',
					'fieldName'=>'string',
					'title'=>'string',
				]);
		}

		// Check if Table exist
		$tablename = \Yii::$app->db->tablePrefix.'user_values';
		if(\Yii::$app->db->schema->getTableSchema($tablename) === null){
			// Create table
			$this->createTable($tablename,
				[
					'id'=>'pk',
					'idField'=>'int',
					'idUser'=>'int',
					'fieldValue'=>'text',
				]);
		}
		ob_clean();
	}
}
