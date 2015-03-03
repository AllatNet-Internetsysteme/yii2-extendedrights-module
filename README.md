yii2-extendedrights
===================

Extended Rights with UserProfile for Yii2


Cofiguration
==================
Set DbManager as default AuthManager class in your main-local.php config

	'components' => [
		'authManager'=>[
				'class'=>'yii\rbac\DbManager',
			],
	    ],


Activate RBAC Auth Manager. Run following on command line

	yii migrate --migrationPath=@yii/rbac/migrations/

Set Module Settings in your main-local.php config

	'modules'    => [
		'extendedrights' => [
			'class' => '\allatnet\yii2\modules\extendedrights\ExtendedRights',
			'params'=>[
				'superuser'=>['Your Superadmin user ID'],
				'guest'=>'DefaultRoleName',
				'loginUrl'=>'/site/login',
				'permissionPrefix'=>'frontend',
				'userModel'=>'app\models\User',
			]
		],
	],

Thats it, it is installed. For custom tables the extension generates itself.

Usage
==================
Admin Panel: domain.tld/extendedrights
Admin Panel is currently only Germen

Get user with Profile

	use allatnet\yii2\modules\extendedrights\components\UserProfile;
	UserProfile::findByUser(idUser);

	// get firstname from custom attributes
	UserProfile::findByUser(idUser)->firstname;

