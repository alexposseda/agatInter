<?php
    namespace backend\models;
    use backend\components\SettingForm;

    class SettingMailForm extends SettingForm{
        public $supportMail;
        public $robotMail;

        public function rules(){
            return [
                [['supportMail', 'robotMail'], 'email']
            ];
        }

        public function attributeLabels(){
            return [
                'supportMail' => 'Support Email',
                'robotMail' => 'Robot Email'
            ];
        }

        public function attributeHints(){
            return [
                'supportMail' => 'Сервисный почтовый адрес',
                'robotMail' => 'Почтовый адрес для отпраки почты с сайта'
            ];
        }

    }