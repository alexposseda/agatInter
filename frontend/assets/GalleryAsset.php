<?php
    namespace frontend\assets;
    use yii\web\AssetBundle;

    class GalleryAsset extends AssetBundle{
        public $sourcePath = "@frontend/assets/files";
        public $css = ['css/slick.css'];
        public $js = ['js/slick.min.js', 'js/gallery.settings.js'];

        public $depends = [
            'frontend\assets\AppAsset'
        ];
    }