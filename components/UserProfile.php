<?php

namespace allatnet\yii2\modules\extendedrights\components;

use allatnet\yii2\modules\extendedrights\ExtendedRights;
use yii\base\Component;
use yii\db\Migration;
use common\models\User;
use allatnet\yii2\modules\extendedrights\models\UserFields;
use allatnet\yii2\modules\extendedrights\models\UserValues;
use yii\helpers\ArrayHelper;

class UserProfile extends Component{

	private $fields = [];

	/**
	 * Find Profile by User
	 *
	 * @param $id ID or Username
	 *
	 * @return UserProfile
	 */
	public static function findByUser($id) {
		$userModel = ExtendedRights::getInstance()->userModel;
		/** @var UserProfile $profile */
		$profile = new UserProfile();

		if(is_int($id)){
			$user = $userModel::findOne(['id'=>$id]);
		}else{
			$user = $userModel::findOne(['username', $id]);
		}

		if(!$user){
			return new UserProfile();
		}

		$profile->id = $user->id;
		$profile->username = $user->username;
		$profile->email = $user->email;
		// get Fields
		$profileFields = UserFields::find()->asArray()->all();
		if(count($profileFields) > 0){
			foreach ($profileFields as $field) {
				$value = '';
				/** @var UserValues $values */
				$values = UserValues::findOne(['idUser'=>$profile->id, 'idField'=>$field['id']]);
				if($values !== null){
					$value = $values->fieldValue;
				}
				$fieldName = $field['fieldName'];
				$profile->$fieldName = $value;
			}
		}
		return $profile;
	}

	/**
	 * @param $id
	 *
	 * @return array
	 */
	public static function getRolesByUser($id) {
		$authManager = \Yii::$app->authManager;
		$rolesReturn = [];
		$roles = $authManager->getRolesByUser($id);
		/** @var \yii\rbac\Role $role */
		foreach ($roles as $role) {
			if($role->type == \yii\rbac\Role::TYPE_ROLE){
				$rolesReturn = ArrayHelper::merge($rolesReturn, self::getChildRolesRecursive($role));
				$rolesReturn[] = $role;
			}
		}
		return $rolesReturn;
	}

	/**
	 * @param $roleName \yii\rbac\Item
	 *
	 * @return array
	 */
	private static function getChildRolesRecursive($roleName) {
		$authManager = \Yii::$app->authManager;
		$rolesReturn = [];
		$roles = $authManager->getChildren($roleName->name);
		foreach ($roles as $role) {
			if($role->type == \yii\rbac\Role::TYPE_ROLE){
				$rolesReturn = ArrayHelper::merge($rolesReturn, self::getChildRolesRecursive($role));
				$rolesReturn[] = $role;
			}
		}
		return $rolesReturn;
	}

	/**
	 * Find all User Profiles
	 *
	 * @return UserProfile[]
	 */
	public static function findAll() {
		$userModel = ExtendedRights::getInstance()->userModel;
		$profiles = [];
		$users = $userModel::find()->all();
		if(count($users) > 0){
			foreach ($users as $user) {
				/** @var UserProfile $profile */
				$profile = new UserProfile();
				$profile->id = $user->id;
				$profile->username = $user->username;
				$profile->email = $user->email;
				/** @var array $profileFields */
				$profileFields = UserFields::find()->asArray()->all();

				if(count($profileFields) > 0){
					foreach ($profileFields as $field) {
						$value = '';
						/** @var UserValues $values */
						$values = UserValues::findOne(['idUser'=>$profile->id, 'idField'=>$field['id']]);
						if($values !== null){
							$value = $values->fieldValue;
						}
						$fieldName = $field['fieldName'];
						$profile->$fieldName = $value;
					}
				}
				$profiles[] = $profile;
			}
		}
		return $profiles;
	}

	/**
	 * Find User Profile
	 *
	 * @param array $attributes
	 *
	 * @return UserProfile
	 */
	public static function findOne($attributes = []) {
		$profile = new UserProfile();
		return $profile;
	}

	/**
	 * Magic getter
	 *
	 * @param string $key
	 *
	 * @return mixed
	 */
	public function __get($key) {
		if(isset($this->fields[$key])){
			return $this->fields[$key];
		}else{
			return false;
		}
	}

	/**
	 * Magic setter
	 *
	 * @param string $key
	 * @param mixed  $value
	 */
	public function __set($key, $value) {
		$this->fields[$key] = $value;
	}

}
