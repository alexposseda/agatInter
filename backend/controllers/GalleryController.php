<?php
    namespace backend\controllers;
    use backend\models\GalleryPictureModel;
    use common\models\GalleryCategory;
    use common\models\GalleryItem;
    use common\models\GalleryModel;
    use Yii;
    use yii\alexposseda\fileManager\FileManager;
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

            if(Yii::$app->request->isPost){
                return var_dump(Yii::$app->request->post());
            }

            return $this->render('create', [
                'model' => $model
            ]);
        }

        public function actionUploadPicture(){

        }
        public function actionRemovePicture(){
            $uploadPath = 'gallery';
            $uploadModel = new GalleryPictureModel();
            $sessionEnable = true;

            $uploadModel->file = UploadedFile::getInstanceByName(FileManager::getInstance()->getAttributeName());
            return FileManager::getInstance()->uploadFile($uploadModel, $uploadPath, $sessionEnable);
        }
    }