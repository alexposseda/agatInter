<?php
    namespace frontend\widgets\SideMenuWidget;

    use yii\web\AssetBundle;

    class SideMenuWidgetAsset extends AssetBundle{
        public $sourcePath = '@frontend/widgets/SideMenuWidget/assets';
        public $css        = ['sideMenu.css'];
        public $js         = ['sideMenu.js'];

        public $depends = ['yii\web\YiiAsset'];
    }