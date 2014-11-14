<?php

namespace app\modules\extendedrights\models;

use Yii;

/**
 * This is the model class for table "hk_user".
 *
 * @property integer $id
 * @property string $fieldName
 * @property string $title
 */
class UserFields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hk_user_fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fieldName', 'title'], 'required'],
            [['fieldName', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fieldName' => 'Feld Name',
            'title' => 'Titel',
        ];
    }
}
