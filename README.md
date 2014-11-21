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
			]
		],
	],

Thats it, it is installed. For custom tables the extension generates itself.