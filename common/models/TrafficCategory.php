<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%traffic_category}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $parentCategory
 *
 * @property TrafficItem[] $trafficItems
 */
class TrafficCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%traffic_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentCategory'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'parentCategory' => 'Parent Category',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrafficItems()
    {
        return $this->hasMany(TrafficItem::className(), ['categoryId' => 'id']);
    }
}
