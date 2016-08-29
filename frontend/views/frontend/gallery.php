<?php
    /** @var \common\models\GalleryCategory[] $modelCategory */
    /** @var \common\models\GalleryItem[] $modelItem */
    /* @var $this yii\web\View */
    use yii\alexposseda\fileManager\FileManager;
    use yii\bootstrap\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;
?>
<div class="col-lg-5">
    <?php foreach($modelCategory as $item): ?>
        <div>
            <div class="">
                <a href="<?= Url::to(['', 'selectedId' => $item->id]) ?>" data-pjax=''><?= $item->title ?></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php Pjax::begin(); ?>
<?php if($modelItem): ?>
    <div class="col-lg-5">
        <?php foreach($modelItem as $item): ?>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?= Html::img(FileManager::getInstance()
                                                 ->getStorageUrl().$item->picture, ['class' => 'img-responsive']) ?>
                    </div>
                    <div class="panel-footer">
                        <?= $item->description ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="col-lg-2">
        <h1><?= $modelItem[0]->category->title ?></h1>
        <?php $randImg = $modelItem[rand(0, count($modelItem) - 1)]->picture ?>
        <?= Html::img(FileManager::getInstance()
                                 ->getStorageUrl().$randImg, ['class' => 'img-responsive']) ?>
    </div>
<?php endif; ?>
<?php Pjax::end() ?>
