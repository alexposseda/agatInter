<?php
    use backend\widgets\uploadPictureWidget\UploadPictureWidget;
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Html;
    use yii\helpers\Url;

    /* @var $this yii\web\View */
    /* @var $model common\models\Service */
    /* @var $form yii\widgets\ActiveForm */
    $uploadedPictures = Yii::$app->session->get('uploadedPictures');
?>

<div class="service-form">
    <?php $form = ActiveForm::begin() ?>
    <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-8">
            <?= $form->field($model, 'title') ?>
            <?= $form->field($model, 'short_description')->textarea(['rows' => 4]) ?>
            <?= $form->field($model, 'full_description')->textarea(['rows' => 8]) ?>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4">
            <?= Html::activeHiddenInput($model, 'icon', ['id' => 'service-icon']) ?>
            <?= UploadPictureWidget::widget([
                                                'uploadUrl' => Url::to(['service/upload-picture']),
                                                'removeUrl' => Url::to(['service/remove-picture']),
                                                'targetInputId' => 'service-icon',
                                                'pictures' => $uploadedPictures
                                            ]) ?>
            <?= ($model->isNewRecord) ? Html::submitButton('Создать услугу',
                                                           ['class' => 'btn btn-success']) : Html::submitButton('Обновить услугу',
                                                                                                                ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end() ?>
</div>

