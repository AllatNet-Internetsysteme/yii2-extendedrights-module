<?php

namespace allatnet\yii2\modules\extendedrights;

class ExtendedRights extends \yii\base\Module
{
    public $controllerNamespace = 'allatnet\yii2\modules\extendedrights\controllers';
    public $userModel = null;

    public function init()
    {

        if(!empty($this->params['userModel'])){
            $this->userModel = $this->params['userModel'];
        }else{
            // Required for Backward Compatibility
            $this->userModel = 'common\models\User';
        }

        if(!class_exists($this->userModel)){
            $this->userModel = 'allatnet\yii2\modules\extendedrights\models\User';
        }

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
