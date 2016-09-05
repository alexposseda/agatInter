<?php
    /**
     * @var \yii\base\View             $this
     * @var \common\models\Certificate $certificateItem
     */
    use yii\alexposseda\fileManager\FileManager;

?>
<div class="certificate-big white fullHeight">
    <div class="certificate-big-content fullHeight">
        <img src="<?= FileManager::getInstance()->getStorageUrl().$certificateItem->icon ?>" alt="<?= $certificateItem->title?>">
    </div>
</div>