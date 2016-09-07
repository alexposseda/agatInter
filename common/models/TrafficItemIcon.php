<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%traffic_item_icon}}".
 *
 * @property integer $id
 * @property string $icon
 *
 * @property TrafficItem[] $trafficItems
 */
class TrafficItemIcon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%traffic_item_icon}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['icon'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'icon' => 'Icon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrafficItems()
    {
        return $this->hasMany(TrafficItem::className(), ['iconId' => 'id']);
    }
}
