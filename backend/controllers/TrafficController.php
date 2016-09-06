<?php
    namespace backend\controllers;
    use common\models\TrafficModel;
    use yii\web\Controller;

    class TrafficController extends Controller{
        public function actionCreate(){
            return $this->render('create', ['model' => new TrafficModel()]);
        }
    }