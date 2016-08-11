<?php
    namespace backend\models;

    use yii\base\Model;

    class UploadPicture extends Model{
        public $picture;

        public function rules(){
            return [
                ['picture', 'file', 'extensions'=>'jpg, png']
            ];
        }
    }