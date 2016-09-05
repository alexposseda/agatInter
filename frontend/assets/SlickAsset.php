<?php
    namespace frontend\assets;
    use yii\web\AssetBundle;

    class SlickAsset extends AssetBundle{
        public $sourcePath = "@frontend/assets/files";
        public $css = ['css/slick.css'];
        public $js = ['js/slick.min.js', 'js/slick.settings.js'];

        public $depends = [
            'frontend\assets\AppAsset'
        ];
    }