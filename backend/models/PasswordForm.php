<?php
    namespace backend\models;

    use Yii;
    use yii\base\Model;

    class PasswordForm extends Model{
        public $oldPassword;
        public $password;
        public $password_repeat;

        public function rules(){
            return [
                [
                    [
                        'oldPassword',
                        'password',
                        'password_repeat'
                    ],
                    'required'
                ],
                [
                    [
                        'oldPassword',
                        'password',
                        'password_repeat'
                    ],
                    'string',
                    'min' => 4
                ],
                [
                    'password',
                    'compare'
                ]
            ];
        }

        public function attributeLabels(){
            return [
                'oldPassword' => 'Текущий пароль',
                'password' => 'Подтвердите новый пароль',
                'password_repeat' => 'Новый пароль'
            ];
        }

        public function setNewPassword(){
            $user = User::findOne(Yii::$app->user->getId());
            if(!$user->validatePassword($this->oldPassword)){
                $this->addError('oldPassword', 'Неверный пароль!');

                return false;
            }

            $user->setPassword($this->password);
            if($user->save()){
                return true;
            }

            return false;
        }
    }