<?php
    use yii\alexposseda\fileManager\FileManager;
    use yii\bootstrap\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

?>

<div class="service col-lg-5">
    <?php foreach($model as $item): ?>
        <div>
            <div>
                <?=Html::img(FileManager::getInstance()
                                        ->getStorageUrl().json_decode($item->foto)[0],['height'=>80])?>
            </div>
            <div class="pull-right">
                <a href="<?= Url::to(['', 'selectedId' => $item->id]) ?>" data-pjax=''><?= $item->title ?></a>
            </div>
            <div class="pull-right">
                <?= $item->description ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php Pjax::begin();?>
<div class="col-lg-5">
    <div>
        <?=Html::img(FileManager::getInstance()
                                ->getStorageUrl().json_decode($selected->foto)[0])?>
    </div>
</div>
<?php Pjax::end(); ?>

