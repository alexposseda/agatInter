<?php
    namespace backend\controllers;

    use backend\models\GalleryModel;
    use backend\models\GalleryPictureModel;
    use backend\models\SearchGalleryItems;
    use common\models\GalleryCategory;
    use common\models\GalleryItem;
    use Yii;
    use yii\alexposseda\fileManager\actions\UploadAction;
    use yii\alexposseda\fileManager\FileManager;
    use yii\alexposseda\fileManager\models\UploadPictureModel;
    use yii\filters\AccessControl;
    use yii\filters\VerbFilter;
    use yii\web\Controller;
    use yii\web\UploadedFile;

    class GalleryController extends Controller{
        public function behaviors(){
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
                                'delete-item'
                            ],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['post'],
                        'upload-picture' => ['post'],
                        'remove-picture' => ['post'],
                        'delete-item' => ['post'],
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
                    'uploadModel' => new GalleryPictureModel([
                                                                'validationRules' => [
                                                                    'extensions' => 'jpg, png',
                                                                    'maxSize' => 1024 * 1024
                                                                ]
                                                            ])
                ],
                'error' => [
                    'class' => 'yii\web\ErrorAction',
                ],
            ];
        }

        public function actionIndex(){
            $galleryCategories = GalleryCategory::find()
                                                ->all();
            $searchModel = new SearchGalleryItems();
            $dataProvider = $searchModel->search(Yii::$app->request->get('categoryId'));

            return $this->render('index', [
                'galleryCategories' => $galleryCategories,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider
            ]);
        }

        public function actionCreate(){
            $model = new GalleryModel();
            if(Yii::$app->request->isPost && $model->loadAndValidate()){
                if($model->createCategory()){
                    $this->redirect([
                                        'index',
                                        'categoryId' => $model->galleryCategory->id
                                    ]);
                }
            }

            return $this->render('create', ['model' => $model]);
        }

        public function actionUpdate($id){
            $model = new GalleryModel(['id' => $id]);
            if(Yii::$app->request->isPost && $model->loadAndValidate()){
                if($model->updateCategory()){
                    $this->redirect([
                                        'index',
                                        'categoryId' => $model->galleryCategory->id
                                    ]);
                }
            }

            return $this->render('update', ['model' => $model]);
        }

        public function actionDelete($id){
            $model = new GalleryModel(['id' => $id]);
            $model->deleteCategory();
            $this->redirect(['index']);
        }

        public function actionDeleteItem(){
            $id = Yii::$app->request->post('id');
            if($id){
                $galleryItem = GalleryItem::findOne($id);
                $result = GalleryPictureModel::removeFile($galleryItem->picture);
                $tmp = json_decode($result);
                if($tmp->success){
                    $galleryItem->delete();
                }

                return $result;
            }
        }

        public function actionRemovePicture(){
            $file = Yii::$app->request->post(FileManager::getInstance()->getAttributeName());
            return GalleryPictureModel::removeFile($file);
        }
    }