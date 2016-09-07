<?php ;
    use backend\assets\MapAsset;
    use yii\alexposseda\fileManager\FileManager;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\web\View;
    use yii\widgets\ActiveForm;

    /* @var $this yii\web\View */
    /* @var $model common\models\TrafficCategory */
    /* @var $form yii\widgets\ActiveForm */

    $this->registerJs('$(".tooltiped").tooltip()', \yii\web\View::POS_END);
    MapAsset::register($this);
    $this->registerJsFile('js/baseMap.js', ['depends' => 'backend\assets\MapAsset']);

    if(!$model->isNewRecord){
        $trafficItems = $model->getTrafficItems()->all();
        if(!is_null($trafficItems)){
            $otherMarkers = [];
            foreach($trafficItems as $otherMarker){
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
    }

?>

<div class="traffic-category-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <?= $form->field($model, 'title')
                             ->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <p class="panel-title">Карта</p>
                </div>
                <div class="panel-body">
                    <div class="map-wrapper">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="panel-title">Объекты</p>
                </div>
                <div class="panel-body">
                    <?php if(!$model->isNewRecord): ?>
                        <a href="<?= Url::to([
                                                 'item-create',
                                                 'categoryId' => $model->id
                                             ]) ?>" class="btn btn-sm btn-success traffic-item-add-btn" style="width: 100%"><span
                                class="glyphicon glyphicon-plus pull-right"></span>Добавить Объект</a>
                    <?php endif; ?>
                    <?php if($model->isNewRecord): ?>
                        <div class="alert alert-warning">Обьеты в данной категории не найденны</div>
                    <?php endif; ?>
                    <?php
                        if(!$model->isNewRecord):
                            $trafficItems = $model->getTrafficItems()
                                                  ->all();
                            if(!is_null($trafficItems)):
                                ?>
                                <div class="traffic-items-wrap panel-group" id="accordion">
                                    <?php
                                        foreach($trafficItems as $item):
                                            ?>
                                            <div class="panel panel-primary traffic-item">
                                                <div class="panel-heading">
                                                    <p class="panel-title">
                                                        <a href="<?= Url::to([
                                                                                 'item-delete',
                                                                                 'id' => $item->id
                                                                             ]) ?>" class="pull-right traffic-item-remove-btn tooltiped"
                                                           data-toggle="tooltip"
                                                           data-placement="bottom" title="удалить"
                                                           data-confirm="вы уверены?"
                                                           data-method="post"
                                                        >
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                        </a>
                                                        <a href="<?= Url::to([
                                                                                 'item-update',
                                                                                 'id' => $item->id
                                                                             ]) ?>" class="pull-right traffic-item-edit-btn tooltiped"
                                                           data-toggle="tooltip"
                                                           data-placement="bottom" title="редактировать">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </a>
                                                        <a href="#trafficItem<?= $item->id ?>" data-toggle="collapse" data-parent="#accordion"
                                                           class="pull-right">
                                                            <span class="glyphicon glyphicon-collapse-down"></span>
                                                        </a>

                                                        <?= $item->title ?>
                                                    </p>
                                                </div>
                                                <div id="trafficItem<?= $item->id ?>" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="traffic-item-description"><?= $item->description ?></div>
                                                        <div class="traffic-item-gallery">
                                                            <?php
                                                                $photos = json_decode($item->cover);
                                                                if(!empty($photos)):
                                                                    foreach($photos as $photo):
                                                                        ?>
                                                                        <div class="traffic-item-pic">
                                                                            <img src="<?= FileManager::getInstance()->getStorageUrl().$photo?>" class="img-thumbnail responsive-img">
                                                                        </div>
                                                                        <?php
                                                                    endforeach;
                                                                endif;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        endforeach;
                                    ?>
                                </div>
                                <?php
                            else:
                                ?>
                                <div class="alert alert-warning">Обьеты в данной категории не найденны</div>
                                <?php
                            endif;
                        endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить',
                               ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
