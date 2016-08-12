<?php
    namespace backend\widgets\uploadPictureWidget;
    use yii\web\AssetBundle;

    class UploadPictureAsset extends AssetBundle{
        public $sourcePath = '@backend/widgets/uploadPictureWidget/assets/';

        public $css = ['uploadPicture.css'];
        public $js = ['uploadPicture.js'];

        public $depends = [
            'backend\assets\AppAsset'
        ];
    }