<?php
    /**
     * @var \yii\base\View         $this
     * @var \common\models\Service $serviceItem
     */
?>
<div class="service-big white fullHeight">
    <div class="service-big-content fullHeight">
        <p class="service-title"><?= $serviceItem->title ?></p>
        <div class="service-description">
            <?= $serviceItem->full_description ?>
        </div>
    </div>
</div>