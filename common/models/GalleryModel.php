<?php
    namespace common\models;
    use yii\base\Model;

    class GalleryModel extends Model{
        public $categoryModel;
        public $items;

        public function load($category, $items){

        }
    }