<?php

namespace app\modules\extendedrights\components;

use yii\base\Component;
use yii\db\Migration;
use common\models\User;
use app\modules\extendedrights\models\UserFields;
use app\modules\extendedrights\models\UserValues;

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
		$profile = new UserProfile();
		if(is_int($id)){
			$user = User::findOne(['id'=>$id]);
		}else{
			$user = User::findOne(['username', $id]);
		}
		$profile->id = $user->id;
		$profile->username = $user->username;
		$profile->email = $user->email;
		// get Fields
		$profileFields = UserFields::find()->all();
		if(count($profileFields) > 0){
			foreach ($profileFields as $field) {
				$value = '';
				$values = UserValues::findOne(['idUser'=>$profile->id, 'idField'=>$field['id']]);
				if($values !== null){
					$value = $values->fieldValue;
				}
				$profile->$field['fieldName'] = $value;
			}
		}
		return $profile;
	}

	/**
	 * Find all User Profiles
	 *
	 * @return array
	 */
	public static function findAll() {
		$profiles = [];
		$users = User::find()->all();
		if(count($users) > 0){
			foreach ($users as $user) {
				$profile = new UserProfile();
				$profile->id = $user->id;
				$profile->username = $user->username;
				$profile->email = $user->email;
				$profileFields = UserFields::find()->all();
				if(count($profileFields) > 0){
					foreach ($profileFields as $field) {
						$value = '';
						$values = UserValues::findOne(['idUser'=>$profile->id, 'idField'=>$field['id']]);
						if($values !== null){
							$value = $values->fieldValue;
						}
						$profile->$field['fieldName'] = $value;
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
		return $this->fields[$key];
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
