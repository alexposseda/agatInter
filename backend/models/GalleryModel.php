<?php
    namespace backend\models;
    use yii\base\Model;

    class GalleryModel extends Model{
        public $galleryCategoryTitle;
        public $galleryItems;

        public
        function rules(){
            return [
                [['galleryCategoryTitle'], 'required'],
                [['galleryCategoryTitle'], 'string', 'max' => 255],
                ['galleryItems', 'safe']
            ];
        }

        public
        function attributeLabels(){
            return [
                'galleryCategoryTitle' => 'Имя категории'
            ];
        }

        public
        function createCategory(){
        }
    }