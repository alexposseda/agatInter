<?php
    namespace backend\controllers;
    use backend\models\SearchTrafficItem;
    use common\models\TrafficCategory;
    use common\models\TrafficItem;
    use Yii;
    use yii\alexposseda\fileManager\actions\UploadAction;
    use yii\alexposseda\fileManager\models\UploadPictureModel;
    use yii\filters\VerbFilter;
    use yii\web\Controller;
    use yii\web\NotFoundHttpException;

    class TrafficController extends Controller{
        /**
         * @inheritdoc
         */
        public function behaviors(){
            return [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ];
        }

        public function actions(){
            return [
                'category-upload-cover' => [
                    'class' => UploadAction::className(),
                    'uploadPath' => 'traffic/categories',
                    'sessionEnable' => true,
                    'uploadModel' => new UploadPictureModel([
                                                                'validationRules' => [
                                                                    'extensions' => 'jpg, png',
                                                                    'maxSize' => 1024 * 50
                                                                ]
                                                            ])
                ],
                'category-remove-cover' => [
                    'class' => '\yii\alexposseda\fileManager\actions\RemoveAction',
                ],
                'item-upload-cover' => [
                    'class' => UploadAction::className(),
                    'uploadPath' => 'traffic/items',
                    'sessionEnable' => true,
                    'uploadModel' => new UploadPictureModel([
                                                                'validationRules' => [
                                                                    'extensions' => 'jpg, png',
                                                                    'maxSize' => 1024 * 1024
                                                                ]
                                                            ])
                ],
                'item-remove-cover' => [
                    'class' => '\yii\alexposseda\fileManager\actions\RemoveAction',
                ]
            ];
        }

        /**
         * Lists all TrafficCategory and TrafficItem models.
         * @return mixed
         */
        public function actionIndex(){
            $traffCategoryModel = TrafficCategory::find()->all();
            $searchModel = new SearchTrafficItem();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'traffCategoryModel' => $traffCategoryModel,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        public function actionCategoryCreate(){
            $model = new TrafficCategory();
            if($model->load(Yii::$app->request->post()) && $model->save()){
                return $this->redirect(['index', 'categoryId' => $model->id]);
            }else{
                return $this->render('createCategory', [
                    'model' => $model,
                ]);
            }
        }

        public function actionCategoryUpdate($id){
            $model = $this->findCategoryModel($id);
            if($model->load(Yii::$app->request->post()) && $model->save()){
                return $this->redirect(['index', 'categoryId' => $model->id]);
            }else{
                return $this->render('updateCategory', [
                    'model' => $model,
                ]);
            }
        }

        public function actionCategoryDelete($id){
            $this->findCategoryModel($id)->delete();

            return $this->redirect(['index']);
        }

        public function actionItemView($id){
            return $this->render('viewItem', [
                'model' => $this->findItemModel($id),
            ]);
        }

        public function actionItemCreate($categoryId){
            $model = new TrafficItem();
            $model->categoryId = $categoryId;
            if(!$model->getCategory()->exists()){
                throw new NotFoundHttpException('The requested page does not exist.');
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['item-view', 'id' => $model->id]);
            } else {
                return $this->render('createItem', [
                    'model' => $model,
                ]);
            }
        }

        public function actionItemUpdate($id){
            $model = $this->findItemModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['item-view', 'id' => $model->id]);
            } else {
                return $this->render('updateItem', [
                    'model' => $model,
                ]);
            }
        }

        public function actionItemDelete($id){
            $model = $this->findItemModel($id);
            $categoryId = $model->categoryId;
            $model->delete();

            return $this->redirect(['index', 'categoryId'=>$categoryId]);
        }

        protected function findCategoryModel($id){
            if(($model = TrafficCategory::findOne($id)) !== null){
                return $model;
            }else{
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }

        protected function findItemModel($id){
            if(($model = TrafficItem::findOne($id)) !== null){
                return $model;
            }else{
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
    }