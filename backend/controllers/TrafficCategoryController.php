<?php

namespace backend\controllers;

use backend\models\UploadPictureModel;
use Yii;
use common\models\TrafficCategory;
use backend\models\SearchTrafficCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TrafficCategoryController implements the CRUD actions for TrafficCategory model.
 */
class TrafficCategoryController extends Controller
{
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
     * Lists all TrafficCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchTrafficCategory();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrafficCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TrafficCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TrafficCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TrafficCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TrafficCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['traffic/index']);
    }

    /**
     * Finds the TrafficCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TrafficCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TrafficCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUploadPicture(){
        $model = new UploadPictureModel();
        $model->picture = UploadedFile::getInstanceByName('picture');
        if($model->validate() && $model->upload(Yii::$app->params['storage']['tmpDir'])){
            return json_encode([
                                   'storageUrl' => Yii::$app->params['storage']['url'],
                                   'path'       => $model->getSavedPath()
                               ]);
        }

        return json_encode(['error' => $model->getErrors()]);
    }

    public function actionRemovePicture(){
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
