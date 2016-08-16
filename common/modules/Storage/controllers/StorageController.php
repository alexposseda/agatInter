<?php

    namespace common\modules\Storage\controllers;

    use common\models\TrafficItem;
    use common\modules\Storage\models\StorageModel;
    use Yii;
    use yii\web\Controller;
    use yii\web\UploadedFile;

    class StorageController extends Controller{

        public function actionIndex(){
            $model = new TrafficItem();
            if($model->load(Yii::$app->request->post()) && $model->save()){

            }

            return $this->render('upload', ['model' => $model]);
        }

        public function actionUpload(){

            return $this->goBack();
        }

        public function actionDelete(){
            return 'Hello_Delete';
        }

        public function actionMove(){
            return 'Hello_Move';
        }

        public function actionUploadPicture(){
            $model = new StorageModel();
            $model->file = UploadedFile::getInstanceByName('picture');
            if($model->validate() && $model->upload(Yii::$app->params['storage']['tmpDir'])){
                return json_encode([
                                       'storageUrl' => Yii::$app->getModule('storage')->BaseURL,
                                       'path'       => $model->getSavedPath()
                                   ]);
            }

            return json_encode(['error' => $model->getErrors()['file']]);
        }
    }