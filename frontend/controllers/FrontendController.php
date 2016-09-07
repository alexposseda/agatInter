<?php

    namespace frontend\controllers;


    use common\models\Certificate;
    use common\models\GalleryCategory;
    use common\models\Service;
    use common\models\TrafficCategory;
    use common\models\TrafficItem;
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

        public function actionCertificates($id = null){
            $certificateItem = Certificate::findOne($id);
            if(Yii::$app->request->isPjax){
                return $this->renderAjax('_certificateItem', ['certificateItem' => $certificateItem]);
            }
            $certificates = Certificate::find()->asArray()->all();
            return $this->render('certificates', ['certificates'=>$certificates, 'certificateItem' => $certificateItem]);
        }


        public function actionTraffic($id, $trafficId = null){
            $trafficCategory = TrafficCategory::findOne($id);
            $trafficItem = TrafficItem::findOne($trafficId);
//            if(Yii::$app->request->isPjax){
//                return $this->renderAjax('_trafficItem', ['trafficItem' => $trafficItem]);
//            }

            return $this->render('traffic', ['trafficCategory'=>$trafficCategory, 'trafficItem' => $trafficItem]);

        }

        public function actionGallery($id){
            $gallery = GalleryCategory::findOne($id);
            return $this->render('gallery', ['gallery' => $gallery]);
        }

        public function actionContacts(){
            return $this->render('contacts');
        }

        public function actionAboutUs(){
            return $this->render('about');
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