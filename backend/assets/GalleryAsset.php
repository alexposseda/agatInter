<?php
    namespace backend\assets;
    use yii\web\AssetBundle;

    class GalleryAsset extends AssetBundle{
        public $sourcePath = '@backend/assets/files/gallery/';

        public $css = ['gallery.css'];
        public $js = ['fileManager.js','gallery.js'];

        public $depends = [
            'backend\assets\AppAsset'
        ];
    }