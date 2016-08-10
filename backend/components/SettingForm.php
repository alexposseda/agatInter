<?php
    namespace backend\components;
    use yii\base\Model;

    class SettingForm extends Model{
        protected $settingModelError = [];

        public function setSettingError($error){
            $settingModelError[] = $error;
        }

        public function getSettingErrors(){
            return $this->settingModelError;
        }
    }