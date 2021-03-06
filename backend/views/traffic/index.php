<?php
    use backend\assets\MapAsset;
    use backend\models\SearchTrafficItem;
    use yii\alexposseda\fileManager\FileManager;
    use yii\helpers\Html;
    use yii\web\View;
    use yii\widgets\ListView;
    use yii\widgets\Pjax;

    /** @var SearchTrafficItem $searchModel */
    /** @var \yii\data\ActiveDataProvider $dataProvider */
    /** @var array $traffCategoryModel */

    MapAsset::register($this);
    $this->registerJsFile('js/baseMap.js', ['depends' => 'backend\assets\MapAsset']);

    $trafficItems = $dataProvider->getModels();
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
?>

<div class="row">

    <?php Pjax::begin() ?>
    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">Виды перевозок</div>
            <div class="panel-body">
                <div class="row text-center">
                    <?= Html::a('Создать вид перевозки', ['category-create'],
                                ['class' => 'btn btn-success', 'data-pjax' => 0]) ?>
                </div>
                <br>
                <div class="list-group">
                    <?php
                        if($traffCategoryModel):
                            $count = 0;
                            foreach($traffCategoryModel as $category):
                                $activeCssClass = '';
                                if(empty(Yii::$app->request->get('SearchTrafficItem')['categoryId']) && $count == 0){
                                    $activeCssClass = ' active';
                                    $count++;
                                }
                                if($category->id == Yii::$app->request->get('SearchTrafficItem')['categoryId']){
                                    $activeCssClass = ' active';
                                }
                                ?>
                                <?= Html::a($category->title,
                                            ['traffic/index', 'SearchTrafficItem[categoryId]' => $category->id],
                                            ['class' => 'list-group-item'.$activeCssClass]);
                                ?>
                                <?php
                            endforeach;
                        else:
                            ?>
                            <div class="alert alert-warning"><strong>Не найдено ни одного вида перевозки</strong></div>
                            <?php
                        endif;
                    ?>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-9">
        <?php if($searchModel->category): ?>
            <div class="panel panel-default">
                <div class="panel-heading"><h2 class="panel-title"><?= $searchModel->category->title ?></h2></div>
                <div class="panel-body">
                    <div class="panel-body">
                        <div class="map-wrapper">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <?= Html::a('Создать Транспорт', ['item-create', 'categoryId' => $searchModel->categoryId],
                                ['class' => 'btn btn-success', 'data-pjax' => 0]) ?>
                    <?= Html::a('Редактировать '.$searchModel->category->title,
                                ['category-update', 'id' => $searchModel->categoryId],
                                ['class' => 'btn btn-primary', 'data-pjax' => 0]) ?>
                    <?= Html::a('Удалить '.$searchModel->category->title,
                                ['category-delete', 'id' => $searchModel->categoryId],
                                ['class' => 'btn btn-danger', 'data' => ['confirm' => 'Вы уверены?']]) ?>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning"><strong>Для данной категории не найдено описание</strong></div>
        <?php endif; ?>
        <div class="panel panel-primary">
            <div class="panel-heading">Транспорт</div>
            <div class="panel-body">
                <?= ListView::widget([
                                         'dataProvider' => $dataProvider,
                                         'itemView' => '_item',
                                         'layout' => "<div class='row'>\n{items}\n</div>\n{pager}",
                                         'emptyText' => 'Транспорт не найден',
                                         'emptyTextOptions' => [
                                             'tag' => 'div',
                                             'class' => 'alert alert-warning'
                                         ]
                                     ]) ?>
            </div>
        </div>
    </div>
    <?php Pjax::end() ?>
</div>