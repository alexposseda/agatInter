<?php
    namespace common\models;
    use Imagine\Image\Box;
    use Yii;
    use yii\alexposseda\fileManager\FileManager;
    use yii\db\ActiveRecord;
    use yii\helpers\FileHelper;
    use yii\imagine\Image;

    /**
     * This is the model class for table "{{%traffic_item}}".
     *
     * @property integer         $id
     * @property integer         $categoryId
     * @property string          $title
     * @property string          $cover
     * @property string          $description
     *
     * @property TrafficCategory $category
     */
    class TrafficItem extends ActiveRecord{
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
                [['categoryId'], 'integer'],
                [['description'], 'string'],
                [['title', 'cover'], 'string', 'max' => 255],
                [
                    ['categoryId'],
                    'exist',
                    'skipOnError' => true,
                    'targetClass' => TrafficCategory::className(),
                    'targetAttribute' => ['categoryId' => 'id']
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
            ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getCategory(){
            return $this->hasOne(TrafficCategory::className(), ['id' => 'categoryId']);
        }

        public function afterSave($insert, $changedAttributes){
            $photos = json_decode($this->cover);
            if(is_array($photos)){
                foreach($photos as $photo){
                    FileManager::getInstance()->removeFromSession($photo);
                }
            }
        }
    }
