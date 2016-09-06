<?php
    namespace common\models;

    use Imagine\Image\Box;
    use Yii;
    use yii\alexposseda\fileManager\FileManager;
    use yii\db\ActiveRecord;
    use yii\helpers\FileHelper;
    use yii\imagine\Image;

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
                        'title',
                        'short_description',
                        'full_description',
                        'icon'
                    ],
                    'required'
                ],
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
                'icon' => 'Обложка',
            ];
        }

        public function afterSave($insert, $changedAttributes){
            $icon = json_decode($this->icon)[0];
            FileManager::getInstance()
                       ->removeFromSession($icon);
        }
    }
