<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/agatinter.css'
    ];
    public $js = [
        'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'macgyer\yii2materializecss\assets\MaterializeAsset',
        'macgyer\yii2materializecss\assets\MaterializePluginAsset',
    ];
}
