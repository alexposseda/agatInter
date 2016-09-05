<?php
    namespace backend\models;
    use Yii;
    use yii\base\Model;

    class SettingPersonalForm extends Model{
        public $email;

        public function rules(){
            return [
                [
                    ['email'], 'email'
                ]
            ];
        }

        public function attributeLabels(){
            return [
                'email' => 'Email'
            ];
        }

        public function save(){
            $user = User::findOne(Yii::$app->user->identity->getId());
            $user->email = $this->email;
            if(!$user->save(true)){
                $this->addError('email', 'Ошибка обновления данных...');
            }
        }
    }