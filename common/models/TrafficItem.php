<?php

    namespace common\models;

    use Imagine\Image\Box;
    use Yii;
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
                [['categoryId'], 'integer'],
                [['description'], 'string'],
                [['title', 'cover'], 'string', 'max' => 255],
                [
                    ['categoryId'],
                    'exist',
                    'skipOnError'     => true,
                    'targetClass'     => TrafficCategory::className(),
                    'targetAttribute' => ['categoryId' => 'id']
                ],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id'          => 'ID',
                'categoryId'  => 'Category ID',
                'title'       => 'Title',
                'cover'       => 'Cover',
                'description' => 'Description',
            ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getCategory(){
            return $this->hasOne(TrafficCategory::className(), ['id' => 'categoryId']);
        }


        public function beforeSave($insert){
            $cover = json_decode($this->cover);
            $coverArr = [];
            foreach($cover as $item){
                if(strrpos($item, '\\')){
                    $coverArr[] = substr($item, strrpos($item, '\\') + 1);
                }else{
                    $coverArr[] = $item;
                }
            }
            //            $this->cover = substr($cover, strrpos($cover, '\\') + 1);
            $this->cover = json_encode($coverArr);

            return true;
        }

        public function afterSave($insert, $changedAttributes){
//            Yii::$app->session->set('uploadedPictures', []);
            $uploadsDirectory = Yii::$app->params['storage']['dir'].DIRECTORY_SEPARATOR.Yii::$app->params['storage']['tmpDir'];
            $directory = Yii::$app->params['storage']['dir'].DIRECTORY_SEPARATOR.'traffic'.DIRECTORY_SEPARATOR.$this->categoryId.DIRECTORY_SEPARATOR.$this->id;
            if(!is_dir($directory)){
                FileHelper::createDirectory($directory);
            }

            $covers = json_decode($this->cover);

            foreach($covers as $cover){
                $image = Image::getImagine()
                              ->open($uploadsDirectory.DIRECTORY_SEPARATOR.$cover);

                $thumbBox = new Box(Yii::$app->params['servicesCover']['width'], Yii::$app->params['servicesCover']['height']);
                $image->thumbnail($thumbBox)
                      ->save($directory.DIRECTORY_SEPARATOR.$cover, ['quality' => 100]);
                unlink($uploadsDirectory.DIRECTORY_SEPARATOR.$cover);
            }


            $uploadedPictures = Yii::$app->session->get('uploadedPictures');
            foreach($uploadedPictures as $picture){
                if(file_exists(Yii::$app->params['storage']['dir'].DIRECTORY_SEPARATOR.$picture)){
                    unlink(Yii::$app->params['storage']['dir'].DIRECTORY_SEPARATOR.$picture);
                }
            }
            Yii::$app->session->set('uploadedPictures', []);
        }
    }
