<?php

namespace allatnet\yii2\modules\extendedrights\models;

use Yii;

/**
 * This is the model class for table "hk_user".
 *
 * @property integer $id
 * @property string $fieldValue
 * @property string $idUser
 * @property string $idField
 */
class UserValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hk_user_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idUser' => 'User ID',
            'idField' => 'Feld ID',
            'fieldvalue' => 'Feld Wert',
        ];
    }
}
