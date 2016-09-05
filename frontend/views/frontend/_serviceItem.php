<?php
    /**
     * @var \yii\base\View $this
     * @var \common\models\Service $serviceItem
     */
?>

<div class="service-item">
    <div class="service-item-content">
        <h4 class="service-item-title"><?= $serviceItem->title?></h4>
        <div class="service-item-description">
            <?= $serviceItem->full_description?>
        </div>
    </div>
</div>
