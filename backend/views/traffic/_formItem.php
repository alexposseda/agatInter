<?php
    use backend\assets\MapAsset;
    use backend\widgets\FileManagerWidget\FileManagerWidget;
    use common\models\TrafficItem;
    use common\models\TrafficItemIcon;
    use yii\alexposseda\fileManager\FileManager;
    use yii\helpers\ArrayHelper;
    use yii\bootstrap\Html;
    use yii\helpers\Url;
    use yii\web\View;
    use yii\widgets\ActiveForm;

    /* @var $this yii\web\View */
    /* @var $model common\models\TrafficItem */
    /* @var $form yii\widgets\ActiveForm */

    MapAsset::register($this);
    $this->registerJsFile('js/trafficItem.js', ['depends' => 'backend\assets\MapAsset']);
    $this->registerJsFile('js/baseMap.js', ['depends' => 'backend\assets\MapAsset']);

    $icons = array_map(function($icon){
        return FileManager::getInstance()
                          ->getStorageUrl().$icon;
    }, ArrayHelper::map(TrafficItemIcon::find()
                                       ->all(), 'id', 'icon'));

    if(!$model->isNewRecord){
        $otherItemInThisCategory = TrafficItem::find()->where(['categoryId' => $model->categoryId])->andWhere(['!=', 'id', $model->id])->all();
    }else{
        $otherItemInThisCategory = TrafficItem::find()->where(['categoryId' => $model->categoryId])->all();
    }
    if(!empty($otherItemInThisCategory)){
        $otherMarkers = [];
        foreach($otherItemInThisCategory as $otherMarker){
            $otherMarkers[] = [
                'title' => $otherMarker->title,
                'id' => $otherMarker->id,
                'coordinates' => $otherMarker->coordinates,
                'icon' => FileManager::getInstance()->getStorageUrl().$otherMarker->icon->icon
            ];
        }
        $otherMarkers = json_encode($otherMarkers);
        $this->registerJs('var otherMarkers='.$otherMarkers.';', View::POS_END);
    }
?>

<div class="traffic-item-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-12 col-md-7 col-lg-7">
            <?= $form->field($model, 'title')
                     ->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'description')
                     ->textarea(['rows' => 6]) ?>

            <div class="panel panel-success">
                <div class="panel-heading">
                    <p class="panel-title">Расположение</p>
                </div>
                <div class="panel-body">
                    <?= Html::activeHiddenInput($model, 'coordinates', ['id' => 'coordinates']) ?>
                    <?= $form->field($model, 'iconId')
                             ->dropDownList($icons, ['prompt' => 'Выберите иконку']) ?>
                    <div class="map-wrapper">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-5 col-lg-5">
            <?= Html::activeHiddenInput($model, 'cover', ['id' => 'item-cover']) ?>
            <?= FileManagerWidget::widget([
                                              'uploadUrl' => Url::to(['item-upload-cover']),
                                              'removeUrl' => Url::to(['item-remove-cover']),
                                              'maxFiles' => 10,
                                              'targetInputId' => 'item-cover',
                                              'files' => $model->cover
                                          ]) ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить',
                                       ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
