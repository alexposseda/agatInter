<?php

    namespace common\modules\Storage;

    use yii\base\Module;

    class StorageModule extends Module{
        public $BaseDir;
        public $BaseURL;

        public function init(){
            parent::init();
        }
    }