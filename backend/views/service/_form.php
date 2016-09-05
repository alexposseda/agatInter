<?php
    use backend\widgets\FileManagerWidget\FileManagerWidget;
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Html;
    use yii\helpers\Url;

    /* @var $this yii\web\View */
    /* @var $model common\models\Service */
    /* @var $form yii\widgets\ActiveForm */
    $uploadedPictures = Yii::$app->session->get('uploadedPictures');
    if(!$model->isNewRecord){
        $uploadedPictures[] = 'services/'.$model->id.'/'.json_decode($model->icon)[0];
    }
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
            <?= FileManagerWidget::widget([
                                              'uploadUrl' => Url::to(['upload-picture']),
                                              'removeUrl' => Url::to(['remove-picture']),
                                              'maxFiles' => 1,
                                              'targetInputId' => 'service-icon',
                                              'files' => $model->icon
                                          ]) ?>
            <?= ($model->isNewRecord) ? Html::submitButton('Создать услугу',
                                                           ['class' => 'btn btn-success']) : Html::submitButton('Обновить услугу',
                                                                                                                ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end() ?>
</div>

