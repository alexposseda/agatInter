<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%certificate}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $short_description
 * @property string $icon
 */
class Certificate extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%certificate}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['short_description'], 'string'],
            [['title', 'icon'], 'string', 'max' => 255],
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
            'short_description' => 'Short Description',
            'icon' => 'Icon',
        ];
    }
}
