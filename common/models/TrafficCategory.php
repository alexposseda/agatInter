<?php

    namespace common\models;

    use Imagine\Image\Box;
    use Yii;
    use yii\helpers\FileHelper;
    use yii\imagine\Image;

    /**
     * This is the model class for table "agi_traffic_category".
     *
     * @property integer       $id
     * @property string        $title
     * @property string        $description
     * @property string        $cover
     * @property string        $map
     *
     * @property TrafficItem[] $trafficItems
     */
    class TrafficCategory extends \yii\db\ActiveRecord{
        /**
         * @inheritdoc
         */
        public static function tableName(){
            return 'agi_traffic_category';
        }

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [['description', 'map'], 'string'],
                [['title', 'cover'], 'string', 'max' => 255],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id'          => 'ID',
                'title'       => 'Title',
                'description' => 'Описание',
                'cover'       => 'Обложка',
                'map'         => 'Карта',
            ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getTrafficItems(){
            return $this->hasMany(TrafficItem::className(), ['categoryId' => 'id']);
        }


        public function beforeSave($insert){
            $cover= json_decode($this->cover)[0];
            $this->cover = substr($cover, strrpos($cover, '\\')+1);
            $this->cover = json_encode([$this->cover]);

            return true;
        }

        public function afterSave($insert, $changedAttributes){
            $uploadsDirectory = Yii::$app->params['storage']['dir'].DIRECTORY_SEPARATOR.Yii::$app->params['storage']['tmpDir'];
            $directory = Yii::$app->params['storage']['dir'].DIRECTORY_SEPARATOR.'traffic'.DIRECTORY_SEPARATOR.$this->id;
            if(!is_dir($directory)){
                FileHelper::createDirectory($directory);
            }

            $this->cover = json_decode($this->cover)[0];

            $image = Image::getImagine()
                          ->open($uploadsDirectory.DIRECTORY_SEPARATOR.$this->cover);

            $thumbBox = new Box(Yii::$app->params['servicesCover']['width'], Yii::$app->params['servicesCover']['height']);
            $image->thumbnail($thumbBox)
                  ->save($directory.DIRECTORY_SEPARATOR.$this->cover, ['quality' => 100]);

            unlink($uploadsDirectory.DIRECTORY_SEPARATOR.$this->cover);

            $uploadedPictures = Yii::$app->session->get('uploadedPictures');
            foreach($uploadedPictures as $picture){
                if(file_exists(Yii::$app->params['storage']['dir'].DIRECTORY_SEPARATOR.$picture)){
                    unlink(Yii::$app->params['storage']['dir'].DIRECTORY_SEPARATOR.$picture);
                }
            }
            Yii::$app->session->set('uploadedPictures', []);
        }
    }
