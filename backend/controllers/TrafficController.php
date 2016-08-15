<?php

    namespace backend\controllers;

    use backend\models\SearchTrafficItem;
    use common\models\TrafficCategory;
    use Yii;
    use yii\filters\VerbFilter;
    use yii\web\Controller;

    class TrafficController extends Controller{
        /**
         * @inheritdoc
         */
        public function behaviors()
        {
            return [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ];
        }

        /**
         * Lists all TrafficCategory and TrafficItem models.
         * @return mixed
         */
        public function actionIndex()
        {
            $traffCategoryModel = TrafficCategory::find()->all();
            $searchModel = new SearchTrafficItem();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'traffCategoryModel'=>$traffCategoryModel,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

    }