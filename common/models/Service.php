<?php
    namespace common\models;
    use Imagine\Image\Box;
    use Yii;
    use yii\db\ActiveRecord;
    use yii\helpers\FileHelper;
    use yii\imagine\Image;

    /**
     * This is the model class for table "{{%service}}".
     *
     * @property integer $id
     * @property string $title
     * @property string $short_description
     * @property string $full_description
     * @property string $icon
     */
    class Service extends ActiveRecord{
        /**
         * @inheritdoc
         */
        public static
        function tableName(){
            return '{{%service}}';
        }

        /**
         * @inheritdoc
         */
        public
        function rules(){
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
        public
        function attributeLabels(){
            return [
                'id' => 'ID',
                'title' => 'Название Услуги',
                'short_description' => 'Короткое описание услуги',
                'full_description' => 'Полное описание услуги',
                'icon' => 'Обложка',
            ];
        }

        public
        function beforeSave($insert){
            $icon = json_decode($this->icon)[0];
            $this->icon = substr($icon, strrpos($icon, '\\')+1);

            return true;
        }

        public
        function afterSave($insert, $changedAttributes){
            $uploadsDirectory = Yii::$app->params['storage']['dir'].DIRECTORY_SEPARATOR.Yii::$app->params['storage']['tmpDir'];
            $directory = Yii::$app->params['storage']['dir'].DIRECTORY_SEPARATOR.'services'.DIRECTORY_SEPARATOR.$this->id;
            if(!is_dir($directory)){
                FileHelper::createDirectory($directory);
            }
            $image = Image::getImagine()->open($uploadsDirectory.DIRECTORY_SEPARATOR.$this->icon);

            $thumbBox = new Box(Yii::$app->params['servicesCover']['width'],Yii::$app->params['servicesCover']['height']);
            $image->thumbnail($thumbBox)
                ->save($directory.DIRECTORY_SEPARATOR.$this->icon, ['quality' => 100]);

            unlink($uploadsDirectory.DIRECTORY_SEPARATOR.$this->icon);

            $uploadedPictures = Yii::$app->session->get('uploadedPictures');
            foreach($uploadedPictures as $picture){
                if(file_exists(Yii::$app->params['storage']['dir'].DIRECTORY_SEPARATOR.$picture)){
                    unlink(Yii::$app->params['storage']['dir'].DIRECTORY_SEPARATOR.$picture);
                }
            }
            Yii::$app->session->set('uploadedPictures', []);
        }
    }
