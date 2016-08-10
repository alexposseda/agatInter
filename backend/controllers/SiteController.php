<?php
    namespace backend\controllers;
    use backend\models\LoginForm;
    use backend\models\SettingMailForm;
    use backend\models\SettingPersonalForm;
    use common\models\Setting;
    use Yii;
    use yii\helpers\ArrayHelper;
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
        public
        function behaviors(){
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => ['login', 'error'],
                            'allow' => true,
                        ],
                        [
                            'actions' => ['logout', 'index', 'setting'],
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
        public
        function actions(){
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
        public
        function actionIndex(){
            return $this->render('index');
        }

        public
        function actionSetting(){
            $successMessage = [];
            $settingMailForm = new SettingMailForm(
                ArrayHelper::map(
                    Setting::find()->where(['LIKE', 'settingName', 'Mail'])->asArray()->all(),
                    'settingName',
                    'settingValue'
                )
            );
            $settingPersonalForm = new SettingPersonalForm(
                [
                    'email' => Yii::$app->user->identity->email
                ]
            );
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

            return $this->render(
                'setting',
                [
                    'settingMailForm' => $settingMailForm,
                    'settingPersonalForm' => $settingPersonalForm,
                    'successMessage' => $successMessage
                ]
            );
        }

        /**
         * Login action.
         *
         * @return string
         */
        public
        function actionLogin(){
            if(!Yii::$app->user->isGuest){
                return $this->goHome();
            }
            $model = new LoginForm();
            if($model->load(Yii::$app->request->post()) && $model->login()){
                return $this->goBack();
            }else{
                return $this->render(
                    'login', [
                               'model' => $model,
                           ]
                );
            }
        }

        /**
         * Logout action.
         *
         * @return string
         */
        public
        function actionLogout(){
            Yii::$app->user->logout();

            return $this->goHome();
        }
    }
