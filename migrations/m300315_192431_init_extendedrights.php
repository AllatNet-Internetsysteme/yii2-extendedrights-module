<?php

use yii\db\Schema;
use yii\db\Migration;

class m300315_192431_init_extendedrights extends Migration
{

	public function safeUp() {
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		// Check if Table exist
		$tablename = \Yii::$app->db->tablePrefix.'user_fields';
		if (\Yii::$app->db->schema->getTableSchema($tablename) === null) {
			// Create table
			$this->createTable('{{%user_fields}}', [
				"id"        => Schema::TYPE_PK,
				"fieldName" => Schema::TYPE_STRING,
				"title"     => Schema::TYPE_STRING,
			], $tableOptions);
		}

		// Check if user_fields Table exist
		$tablename = \Yii::$app->db->tablePrefix.'user_values';
		if (\Yii::$app->db->schema->getTableSchema($tablename) === null) {
			// Create user_fields table
			$this->createTable('{{%user_values}}', [
				"id"         => Schema::TYPE_PK,
				"idField"  => Schema::TYPE_INTEGER,
				"idUser"     => Schema::TYPE_INTEGER,
				"fieldValue" => Schema::TYPE_TEXT,
			], $tableOptions);
		}

		// Check if user Table exist
		$tablename = \Yii::$app->db->tablePrefix.'user';
		if (\Yii::$app->db->schema->getTableSchema($tablename) === null) {
			// Create user table
			$this->createTable('{{%user}}', [
				"id"                   => Schema::TYPE_PK,
				"username"             => Schema::TYPE_STRING,
				"auth_key"             => Schema::TYPE_STRING,
				"password_hash"        => Schema::TYPE_STRING,
				"password_reset_token" => Schema::TYPE_STRING,
				"email"                => Schema::TYPE_STRING,
				"role"                 => Schema::TYPE_SMALLINT,
				"status"               => Schema::TYPE_SMALLINT,
				"created_at"           => Schema::TYPE_INTEGER,
				"updated_at"           => Schema::TYPE_INTEGER,
			], $tableOptions);

			// Insert Admin
			$columns = ['username', 'password_hash', 'created_at'];
			$this->batchInsert('{{%user}}', $columns, [
				[
					'admin',
					\Yii::$app->security->generatePasswordHash('admin'),
					time()
				],
			]);
		}
	}

	public function safeDown() {
		$this->dropTable('{{%user_fields}}');
		$this->dropTable('{{%user_values}}');
		$this->dropTable('{{%user}}');
	}
}