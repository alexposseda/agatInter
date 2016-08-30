<?php

    namespace frontend\controllers;


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

        public function actionServices(){
            return $this->render('index');
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