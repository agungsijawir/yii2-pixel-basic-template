<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "configurations".
 *
 * @property string $id
 * @property string $value
 * @property string $group
 * @property string $updated_at
 */
class Configurations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'configurations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'string'],
            [['updated_at'], 'safe'],
            [['id', 'group'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'value' => Yii::t('app', 'Value'),
            'group' => Yii::t('app', 'Group'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
