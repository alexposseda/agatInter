<?php

    namespace common\models;

    use Yii;
    use yii\db\ActiveRecord;

    /**
     * This is the model class for table "{{%service}}".
     *
     * @property integer $id
     * @property string  $title
     * @property string  $short_description
     * @property string  $full_description
     * @property string  $icon
     */
    class Service extends ActiveRecord{
        /**
         * @inheritdoc
         */
        public static function tableName(){
            return '{{%service}}';
        }

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [
                    [
                        'short_description',
                        'full_description'
                    ],
                    'string'
                ],
                [
                    [
                        'title',
                        'icon'
                    ],
                    'string',
                    'max' => 255
                ],
            ];
        }

    /**
     * @inheritdoc
     */
    public function attributeLabels(){
        return [
            'id' => 'ID',
            'title' => 'Название Услуги',
            'short_description' => 'Короткое описание услуги',
            'full_description' => 'Полное описание услуги',
            'icon' => 'Icon',
        ];
    }
}
