<?php

    namespace common\modules\Storage\controllers;

    use common\models\TrafficItem;
    use common\modules\Storage\models\StorageModel;
    use Yii;
    use yii\web\Controller;
    use yii\web\UploadedFile;

    class StorageController extends Controller{

        public function actionIndex(){
            //Yii::$app->session->set('picture', []);
            $model = new TrafficItem();
            $uploadFile = Yii::$app->session->get('picture');
            if($uploadFile){
                StorageModel::resizeImage(Yii::$app->getModule('storage')->BaseDir.DIRECTORY_SEPARATOR.Yii::$app->params['storage']['tmpDir'], $uploadFile);

                StorageModel::move(
                    Yii::$app->getModule('storage')->BaseDir.DIRECTORY_SEPARATOR.Yii::$app->params['storage']['tmpDir'],
                    Yii::$app->getModule('storage')->BaseDir.DIRECTORY_SEPARATOR.'test',
                    $uploadFile);
                Yii::$app->session->set('picture', []);
            }

            return $this->render('upload', ['model' => $model]);
        }

        public function actionUpload(){
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

        public function actionDelete(){
            $path = Yii::$app->request->post('path');

            return StorageModel::delete($path);
        }

    }