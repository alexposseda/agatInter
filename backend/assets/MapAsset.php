<?php

    namespace backend\assets;

    use yii\web\AssetBundle;

    class MapAsset extends AssetBundle{
        const APIKEY = '';

        public $sourcePath = '@backend/assets/files/map/';

        public $css = ['map.css'];
        public $js = ['https://maps.googleapis.com/maps/api/js?key='.self::APIKEY,'map.js'];

        public $depends = [
            'backend\assets\AppAsset'
        ];
    }