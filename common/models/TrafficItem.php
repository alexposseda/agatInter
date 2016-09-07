<?php

    namespace common\models;

    use Yii;
    use yii\alexposseda\fileManager\FileManager;

    /**
     * This is the model class for table "{{%traffic_item}}".
     *
     * @property integer         $id
     * @property integer         $categoryId
     * @property string          $title
     * @property string          $cover
     * @property string          $description
     * @property string          $coordinates
     * @property integer         $iconId
     *
     * @property TrafficCategory $category
     * @property TrafficItemIcon $icon
     */
    class TrafficItem extends \yii\db\ActiveRecord{
        /**
         * @inheritdoc
         */
        public static function tableName(){
            return '{{%traffic_item}}';
        }

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [
                    [
                        'title',
                        'iconId'
                    ],
                    'required'
                ],
                [
                    [
                        'categoryId',
                        'iconId'
                    ],
                    'integer'
                ],
                [
                    ['description'],
                    'string'
                ],
                [
                    [
                        'title',
                        'cover',
                        'coordinates'
                    ],
                    'string',
                    'max' => 255
                ],
                [
                    ['categoryId'],
                    'exist',
                    'skipOnError' => true,
                    'targetClass' => TrafficCategory::className(),
                    'targetAttribute' => ['categoryId' => 'id']
                ],
                [
                    ['iconId'],
                    'exist',
                    'skipOnError' => false,
                    'targetClass' => TrafficItemIcon::className(),
                    'targetAttribute' => ['iconId' => 'id']
                ],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id' => 'ID',
                'categoryId' => 'Category ID',
                'title' => 'Название',
                'cover' => 'Cover',
                'description' => 'Описание',
                'coordinates' => 'Coordinates',
                'iconId' => 'Иконка',
            ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getCategory(){
            return $this->hasOne(TrafficCategory::className(), ['id' => 'categoryId']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getIcon(){
            return $this->hasOne(TrafficItemIcon::className(), ['id' => 'iconId']);
        }

        public function afterSave($insert, $changedAttributes){
            $files = json_decode($this->cover);
            if($files){
                foreach($files as $file){
                    FileManager::getInstance()
                               ->removeFromSession($file);
                }
            }
        }
    }
