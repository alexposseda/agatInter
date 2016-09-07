<?php
    /**
     * @var \yii\web\View $this
     * @var \common\models\TrafficCategory $trafficCategory
     * @var \common\models\TrafficItem $trafficItem
     */

    use frontend\assets\MapAsset;
    use yii\alexposseda\fileManager\FileManager;
    use yii\helpers\Url;
    use yii\web\View;
    use yii\widgets\Pjax;

    MapAsset::register($this);
    $this->registerJsFile('js/baseMap.js', ['depends' => 'frontend\assets\MapAsset']);

    $trafficItems = $trafficCategory->getTrafficItems()
                                    ->all();
    if(!is_null($trafficItems)){
        $otherMarkers = [];
        foreach($trafficItems as $otherMarker){
            $otherMarkers[] = [
                'title' => $otherMarker->title,
                'id' => $otherMarker->id,
                'coordinates' => $otherMarker->coordinates,
                'icon' => FileManager::getInstance()
                                     ->getStorageUrl().$otherMarker->icon->icon
            ];
        }
        $otherMarkers = json_encode($otherMarkers);
        $this->registerJs('var otherMarkers='.$otherMarkers.';', View::POS_END);
    }
?>
<div class="map-wrapper">
    <div id="map" class="map"></div>
</div>
<?php Pjax::begin([
                      'id' => 'trafficItem'
                  ]) ?>

<?php Pjax::end() ?>
<?php Pjax::begin() ?>
<?php if(!is_null($trafficItem)): ?>
    <?= $this->render('_trafficItem', ['trafficItem' => $trafficItem]) ?>
<?php endif; ?>
<div id="links">
    <?php foreach($trafficItems as $item): ?>
        <a href="<?= Url::to([
                                              'traffic',
                                              'id' => $trafficCategory->id,
                                              'trafficId' => $item->id
                                          ]) ?>" id="trafficItemLink-<?= $item->id?>"></a>
    <?php endforeach; ?>
</div>
<?php Pjax::end() ?>

