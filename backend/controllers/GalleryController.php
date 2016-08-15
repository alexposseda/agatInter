<?php
    namespace backend\controllers;
    use backend\models\GalleryModel;
    use backend\models\UploadPictureModel;
    use Yii;
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
                                'create-category',
                                'update-category',
                                'delete-category',
                                'upload-picture',
                                'remove-picture'
                            ],
                            'allow' => true,
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete-category' => ['post'],
                        'upload-picture' => ['post'],
                        'remove-picture' => ['post'],
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

        public
        function actionIndex(){
            return $this->render('index');
        }

        public
        function actionCreateCategory(){
            $galleryModel = new GalleryModel();
            if($galleryModel->load(Yii::$app->request->post())){
                //todo
            }

            return $this->render('create', ['galleryModel' => $galleryModel]);
        }

        public
        function actionDeleteCategory($id){
        }

        public
        function actionUpdateCategory($id){
        }

        public
        function actionUploadPicture(){
            $model = new UploadPictureModel();
            $model->picture = UploadedFile::getInstanceByName('picture');
            if($model->validate() && $model->upload(Yii::$app->params['storage']['tmpDir'])){
                return json_encode([
                                       'storageUrl' => Yii::$app->params['storage']['url'],
                                       'path' => $model->getSavedPath()
                                   ]);
            }

            return json_encode(['error' => $model->getErrors()]);
        }

        public
        function actionRemovePicture(){
            $path = Yii::$app->request->post('path');
            if($path && file_exists(Yii::$app->params['storage']['dir'].DIRECTORY_SEPARATOR.$path)){
                unlink(Yii::$app->params['storage']['dir'].DIRECTORY_SEPARATOR.$path);
                $uploadedPictures = Yii::$app->session->get('uploadedPictures');
                foreach($uploadedPictures as $key => $value){
                    if($value == $path){
                        unset($uploadedPictures[$key]);
                        $uploadedPictures = array_values($uploadedPictures);
                    }
                }
                Yii::$app->session->set('uploadedPictures', $uploadedPictures);

                return true;
            }

            return false;
        }
    }