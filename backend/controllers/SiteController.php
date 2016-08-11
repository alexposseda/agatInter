<?php
    namespace backend\controllers;

    use backend\models\LoginForm;
    use backend\models\PasswordForm;
    use backend\models\PasswordResetRequestForm;
    use backend\models\ResetPasswordForm;
    use backend\models\SettingMailForm;
    use backend\models\SettingPersonalForm;
    use common\models\Setting;
    use Yii;
    use yii\base\InvalidParamException;
    use yii\helpers\ArrayHelper;
    use yii\web\BadRequestHttpException;
    use yii\web\Controller;
    use yii\filters\VerbFilter;
    use yii\filters\AccessControl;

    /**
     * Site controller
     */
    class SiteController extends Controller{
        /**
         * @inheritdoc
         */
        public function behaviors(){
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => [
                                'login',
                                'error',
                                'request-password-reset',
                                'reset-password'
                            ],
                            'allow' => true,
                        ],
                        [
                            'actions' => [
                                'logout',
                                'index',
                                'setting'
                            ],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'logout' => ['post'],
                    ],
                ],
            ];
        }

        /**
         * @inheritdoc
         */
        public function actions(){
            return [
                'error' => [
                    'class' => 'yii\web\ErrorAction',
                ],
            ];
        }

        /**
         * Displays homepage.
         *
         * @return string
         */
        public function actionIndex(){
            return $this->render('index');
        }

        public function actionSetting(){
            $successMessage = [];
            $settingMailForm = new SettingMailForm(ArrayHelper::map(Setting::find()
                                                                           ->where([
                                                                                       'LIKE',
                                                                                       'settingName',
                                                                                       'Mail'
                                                                                   ])
                                                                           ->asArray()
                                                                           ->all(), 'settingName', 'settingValue'));
            $settingPersonalForm = new SettingPersonalForm([
                                                               'email' => Yii::$app->user->identity->email
                                                           ]);

            $passwordForm = new PasswordForm();

            if($settingMailForm->load(Yii::$app->request->post()) && $settingMailForm->validate()){
                Setting::saveSetting($settingMailForm);
                if(!$settingMailForm->hasErrors()){
                    $successMessage['mailForm'] = 'Данные успешно обновлены!';
                }
            }
            if($settingPersonalForm->load(Yii::$app->request->post()) && $settingPersonalForm->validate()){
                $settingPersonalForm->save();
                if(!$settingPersonalForm->hasErrors()){
                    $successMessage['personalForm'] = 'Данные успешно обновлены!';
                }
            }

            if($passwordForm->load(Yii::$app->request->post()) && $passwordForm->validate()){
                if($passwordForm->setNewPassword()){
                    $successMessage['passwordForm'] = 'Пароль успешно изменен!';
                }
            }

            return $this->render('setting', [
                                              'settingMailForm' => $settingMailForm,
                                              'settingPersonalForm' => $settingPersonalForm,
                                              'passwordForm' => $passwordForm,
                                              'successMessage' => $successMessage
                                          ]);
        }

        /**
         * Login action.
         *
         * @return string
         */
        public function actionLogin(){
            if(!Yii::$app->user->isGuest){
                return $this->goHome();
            }
            $model = new LoginForm();
            if($model->load(Yii::$app->request->post()) && $model->login()){
                return $this->goBack();
            }else{
                return $this->render('login', [
                                                'model' => $model,
                                            ]);
            }
        }

        /**
         * Logout action.
         *
         * @return string
         */
        public function actionLogout(){
            Yii::$app->user->logout();

            return $this->goHome();
        }

        public function actionRequestPasswordReset(){
            $model = new PasswordResetRequestForm();
            if($model->load(Yii::$app->request->post()) && $model->validate()){
                if($model->sendEmail()){
                    Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                    return $this->goHome();
                }else{
                    Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
                }
            }

            return $this->render('requestPasswordResetToken', [
                'model' => $model,
            ]);
        }

        public function actionResetPassword($token){
            try{
                $model = new ResetPasswordForm($token);
            }catch(InvalidParamException $e){
                throw new BadRequestHttpException($e->getMessage());
            }

            if($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()){
                Yii::$app->session->setFlash('success', 'New password was saved.');

                return $this->goHome();
            }

            return $this->render('resetPassword', [
                'model' => $model,
            ]);
        }
    }
