yii2-extendedrights
===================

Extended Rights with UserProfile for Yii2


Cofiguration
==================
Put following into your main-local.php
------------------------
	'modules'    => [
		'extendedrights' => [
			'class' => '\allatnet\yii2\modules\extendedrights\ExtendedRights',
			'params'=>[
				'superuser'=>['Your Superadmin user ID'],
				'guest'=>'DefaultRoleName',
				'loginUrl'=>'/site/login',
			]
		],
	],
------------------------
