<?php

    namespace frontend\controllers;


    use common\models\Service;
    use Yii;
    use yii\web\Controller;

    class FrontendController extends Controller{

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

        public function actionServices($id = null){
            $serviceItem = Service::findOne($id);
            if(Yii::$app->request->isPjax){
                return $this->renderAjax('_serviceItem', ['serviceItem' => $serviceItem]);
            }
            $services = Service::find()->asArray()->all();
            return $this->render('services', ['services'=>$services, 'serviceItem' => $serviceItem]);
        }


        public function actionTraffic($id){
            return $this->render('index');
        }

        public function actionGallery($id){
            return $this->render('index');
        }

        public function actionCertificates(){
            return $this->render('index');
        }

        public function actionContacts(){
            return $this->render('index');
        }

        public function actionAboutUs(){
            return $this->render('index');
        }

        public function actionTest(){
            return 'test is ok';
        }
//        public function actionsContact(){
//            return $this->render('contact');
//        }
//
//        public function actionsAbout(){
//            return $this->render('about');
//        }
//
//        public function actionIndex(){
//            return $this->render('index');
//        }
//
//        public function actionGallery($selectedId = null){
//            $modelCategory = GalleryCategory::find()
//                                            ->all();
//            $modelItem = GalleryItem::findAll(['categoryId' => $selectedId]);
//
//            return $this->render('gallery', [
//                'modelCategory' => $modelCategory,
//                'modelItem'     => $modelItem
//            ]);
//        }
//
//        public function actionService($selectedId = null){
//            $model = Service::find()
//                            ->all();
//            $selectedModel = Service::findOne($selectedId);
//
//            return $this->render('service', [
//                'model'         => $model,
//                'selectedModel' => $selectedModel
//            ]);
//        }
//
//        public function actionCertificate($selectedId = null){
//            $modelCertificate = Certificate::find()
//                                           ->all();
//            $selected = Certificate::findOne($selectedId);
//
//            return $this->render('certificate', [
//                'modelCategory' => $modelCertificate,
//                'selected'      => $selected
//            ]);
//        }
//

    }