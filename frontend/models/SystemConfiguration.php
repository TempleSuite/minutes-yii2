<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "system_configuration".
 *
 * @property integer $id
 * @property integer $company_id
 */
class SystemConfiguration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_configuration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id'], 'required'],
            [['company_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
        ];
    }
}
