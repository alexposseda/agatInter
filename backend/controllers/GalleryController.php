<?php
    namespace backend\controllers;
    use backend\models\GalleryPictureModel;
    use common\models\GalleryCategory;
    use common\models\GalleryItem;
    use common\models\GalleryModel;
    use Yii;
    use yii\alexposseda\fileManager\actions\UploadAction;
    use yii\alexposseda\fileManager\FileManager;
    use yii\alexposseda\fileManager\models\UploadPictureModel;
    use yii\filters\AccessControl;
    use yii\filters\VerbFilter;
    use yii\web\Controller;
    use yii\web\UploadedFile;

    class GalleryController extends Controller{
        public
        function behaviors(){
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => [
                                'index',
                                'create',
                                'update',
                                'delete',
                                'upload-picture',
                                'remove-picture',
                            ],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete-category' => ['post'],
                    ],
                ],
            ];
        }

        /**
         * @inheritdoc
         */
        public function actions(){
            return [
                'upload-picture' => [
                    'class' => UploadAction::className(),
                    'uploadPath' => 'gallery',
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
                ],
                'error' => [
                    'class' => 'yii\web\ErrorAction',
                ],
            ];
        }

        public function actionIndex(){
            return $this->render('index');
        }

        public function actionCreate(){
            $model = new GalleryModel();
            $model->categoryModel = new GalleryCategory();

            if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post())){
                if($model->save()){
                    $this->redirect(['index']);
                }
            }

            return $this->render('create', [
                'model' => $model
            ]);
        }
    }