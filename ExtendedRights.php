<?php

namespace allatnet\yii2\modules\extendedrights;

class ExtendedRights extends \yii\base\Module
{
    public $controllerNamespace = 'allatnet\yii2\modules\extendedrights\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getPermissionPrefix() {
        $extendedRights = \Yii::$app->getModule('extendedrights');
        $permissionPrefix = '';
        if (isset($extendedRights->params['permissionPrefix']))
            $permissionPrefix = $extendedRights->params['permissionPrefix'];
        if(!empty($permissionPrefix))
            $permissionPrefix = $permissionPrefix.'.';
        return $permissionPrefix;
    }
}
