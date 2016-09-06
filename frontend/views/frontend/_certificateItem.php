<?php
    /**
     * @var \yii\base\View             $this
     * @var \common\models\Certificate $certificateItem
     */
    use backend\models\CertificateUploadModel;

?>
<div class="certificate-big white fullHeight">
    <div class="certificate-big-content fullHeight">
        <img src="<?= CertificateUploadModel::getBase(json_decode($certificateItem->icon)[0]) ?>" alt="<?= $certificateItem->title?>">
    </div>
</div>