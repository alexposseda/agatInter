<?php
    namespace backend\models;

    use common\models\Setting;
    use Yii;
    use yii\base\Model;

    /**
     * Password reset request form
     */
    class PasswordResetRequestForm extends Model{
        public $email;


        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [
                    'email',
                    'trim'
                ],
                [
                    'email',
                    'required'
                ],
                [
                    'email',
                    'email'
                ],
                [
                    'email',
                    'exist',
                    'targetClass' => '\backend\models\User',
                    'filter' => ['status' => User::STATUS_ACTIVE],
                    'message' => 'There is no user with such email.'
                ],
            ];
        }

        /**
         * Sends an email with a link, for resetting the password.
         *
         * @return boolean whether the email was send
         */
        public function sendEmail(){
            /* @var $user User */
            $user = User::findOne([
                                      'status' => User::STATUS_ACTIVE,
                                      'email' => $this->email,
                                  ]);

            if(!$user){
                return false;
            }

            if(!User::isPasswordResetTokenValid($user->password_reset_token)){
                $user->generatePasswordResetToken();
                if(!$user->save()){
                    return false;
                }
            }

            return Yii::$app->mailer->compose([
                                                  'html' => 'passwordResetToken-html',
                                                  'text' => 'passwordResetToken-text'
                                              ], ['user' => $user])
                                    ->setFrom([Setting::findOne(['settingName' => 'robotMail'])->settingValue => Yii::$app->name.' Robot'])
                                    ->setTo($this->email)
                                    ->setSubject('Пароль для доступа к '.Yii::$app->name)
                                    ->send();
        }
    }