yii2-extendedrights
===================

Extended Rights with UserProfile for Yii2


Cofiguration
==================
Set DbManager as default AuthManager and User-Identity class in your main-local.php config

	'components' => [
		'authManager'=>[
			'class'=>'yii\rbac\DbManager',
        	'defaultRoles'=>['guest'],
		],
        'user' => [
            'identityClass' => '\allatnet\yii2\modules\extendedrights\models\User',
            'class' => 'yii\web\User',
        ],
	],


Activate RBAC Auth Manager. Run following on command line

	yii migrate --migrationPath=@yii/rbac/migrations/

Migrate Extendedrights Tables

	yii migrate --migrationPath=@vendor/allatnet-internetsysteme/yii2-extendedrights-module/migrations

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

Make Sure that you Use Extendedrights its Own User identity class. Don't use Yii2's default identity class

Thats it, it is installed.

Login with

	User: admin
	Passwort: admin

Usage
==================
Admin Panel: domain.tld/extendedrights
Admin Panel is currently only German

Get user with Profile

	use allatnet\yii2\modules\extendedrights\components\UserProfile;
	UserProfile::findByUser(idUser);

	// get firstname from custom attributes
	UserProfile::findByUser(idUser)->firstname;

