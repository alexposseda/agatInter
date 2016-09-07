<?php

    namespace frontend\assets;

    use yii\web\AssetBundle;

    class MapAsset extends AssetBundle{
        const APIKEY = 'AIzaSyBTUQD7LyzcjXqAjCONxvNMSYCyvdnQ5Cw';

        public $sourcePath = '@frontend/assets/files/';

        public $js = ['https://maps.googleapis.com/maps/api/js?key='.self::APIKEY,'js/map.js'];

        public $depends = [
            'frontend\assets\AppAsset'
        ];
    }