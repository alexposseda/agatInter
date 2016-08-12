<?php
    namespace backend\models;
    use Yii;
    use yii\base\Model;
    use yii\helpers\FileHelper;

    class UploadPictureModel extends Model{
        public    $picture;
        protected $savedPath;

        public
        function rules(){
            return [
                [
                    ['picture'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 1,
                    'maxSize' => 1024 * 1024
                ]
            ];
        }

        public
        function upload($directory){
            $storageDir = Yii::$app->params['storage']['dir'];
            $fileName = uniqid(time(), true).'.'.$this->picture->extension;
            $path = FileHelper::normalizePath($storageDir.DIRECTORY_SEPARATOR.$directory.DIRECTORY_SEPARATOR.$fileName);
            if($this->picture->saveAs($path)){
                $this->savedPath = $directory.DIRECTORY_SEPARATOR.$fileName;
                $uploadedPictures = Yii::$app->session->get('uploadedPictures');
                if(!$uploadedPictures){
                    $uploadedPictures = [];
                }
                $uploadedPictures[] = $directory.DIRECTORY_SEPARATOR.$fileName;
                Yii::$app->session->set('uploadedPictures', $uploadedPictures);

                return true;
            }

            return false;
        }

        public
        function getSavedPath(){
            return $this->savedPath;
        }
    }