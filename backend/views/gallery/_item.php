<?php
    /** @var \common\models\GalleryItem $model */
    use yii\alexposseda\fileManager\FileManager;
    use yii\bootstrap\Html;

?>
<div class="col-sm-12 col-md-6 col-lg-4">
    <div class="panel panel-default">
        <div class="panel-body">
            <?= Html::img(FileManager::getInstance()->getStorageUrl().$model->picture, ['class'=> 'img-responsive'])?>
        </div>
        <div class="panel-footer">
            <?= $model->description ?>
        </div>
    </div>
</div>
