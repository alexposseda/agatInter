<?php
    /** @var \common\models\Service[] $model */
    use yii\alexposseda\fileManager\FileManager;
    use yii\bootstrap\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

    /** @var \common\models\Service $selectedModel */

?>

<div class="service col-lg-5">
    <?php foreach($model as $item): ?>
        <div>
            <div>
                <?=Html::img(FileManager::getInstance()
                                        ->getStorageUrl().json_decode($item->icon)[0],['height'=>80])?>
            </div>
            <div class="pull-right">
                <a href="<?= Url::to(['', 'selectedId' => $item->id]) ?>" data-pjax=''><?= $item->title ?></a>
            </div>
            <div class="pull-right">
                <?= $item->short_description ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php Pjax::begin();?>
    <div class="col-lg-5">
        <div><h1><?= $selectedModel->title?></h1></div>
        <div><?=$selectedModel->full_description?></div>
    </div>
<?php Pjax::end(); ?>
