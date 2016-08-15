<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%traffic_item}}".
 *
 * @property integer $id
 * @property integer $categoryId
 * @property string $title
 * @property string $cover
 * @property string $description
 *
 * @property TrafficCategory $category
 */
class TrafficItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%traffic_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryId'], 'integer'],
            [['description'], 'string'],
            [['title', 'cover'], 'string', 'max' => 255],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => TrafficCategory::className(), 'targetAttribute' => ['categoryId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoryId' => 'Category ID',
            'title' => 'Title',
            'cover' => 'Cover',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(TrafficCategory::className(), ['id' => 'categoryId']);
    }
}
