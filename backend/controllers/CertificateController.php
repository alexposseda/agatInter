<?php

    namespace backend\controllers;

    use Yii;
    use common\models\Certificate;
    use common\models\CertificateSearch;
    use yii\alexposseda\fileManager\actions\UploadAction;
    use yii\alexposseda\fileManager\models\UploadPictureModel;
    use yii\filters\AccessControl;
    use yii\web\Controller;
    use yii\web\NotFoundHttpException;
    use yii\filters\VerbFilter;

    /**
     * CertificateController implements the CRUD actions for Certificate model.
     */
    class CertificateController extends Controller{
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
                                'index',
                                'create',
                                'view',
                                'update',
                                'delete',
                                'upload-picture',
                                'remove-picture'
                            ],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        'upload-picture' => ['POST'],
                        'remove-picture' => ['POST']
                    ],
                ],
            ];
        }

        public function actions(){
            return [
                'upload-picture' => [
                    'class' => UploadAction::className(),
                    'uploadPath' => 'certificates',
                    'sessionEnable' => true,
                    'uploadModel' => new UploadPictureModel([
                                                                'validationRules' => [
                                                                    'extensions' => 'jpg, png',
                                                                    'maxSize' => 1024 * 1024
                                                                ]
                                                            ])
                ],
                'remove-picture' => [
                    'class' => '\yii\alexposseda\fileManager\actions\RemoveAction',
                ]
            ];
        }
        /**
         * Lists all Certificate models.
         * @return mixed
         */
        public function actionIndex(){
            $searchModel = new CertificateSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        /**
         * Displays a single Certificate model.
         *
         * @param integer $id
         *
         * @return mixed
         */
        public function actionView($id){
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }

        /**
         * Creates a new Certificate model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate(){
            $model = new Certificate();

            if($model->load(Yii::$app->request->post()) && $model->save()){
                return $this->redirect([
                                           'view',
                                           'id' => $model->id
                                       ]);
            }else{
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

        /**
         * Updates an existing Certificate model.
         * If update is successful, the browser will be redirected to the 'view' page.
         *
         * @param integer $id
         *
         * @return mixed
         */
        public function actionUpdate($id){
            $model = $this->findModel($id);

            if($model->load(Yii::$app->request->post()) && $model->save()){
                return $this->redirect([
                                           'view',
                                           'id' => $model->id
                                       ]);
            }else{
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }

        /**
         * Deletes an existing Certificate model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         *
         * @param integer $id
         *
         * @return mixed
         */
        public function actionDelete($id){
            $this->findModel($id)
                 ->delete();

            return $this->redirect(['index']);
        }

        /**
         * Finds the Certificate model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         *
         * @param integer $id
         *
         * @return Certificate the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id){
            if(($model = Certificate::findOne($id)) !== null){
                return $model;
            }else{
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
    }
