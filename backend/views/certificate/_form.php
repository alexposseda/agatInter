<?php

    use backend\widgets\FileManagerWidget\FileManagerWidget;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;

    /* @var $this yii\web\View */
    /* @var $model common\models\Certificate */
    /* @var $form yii\widgets\ActiveForm */
?>

<div class="certificate-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-8">
            <?= $form->field($model, 'title')
                     ->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'short_description')
                     ->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4">
            <?= Html::activeHiddenInput($model, 'icon', ['id' => 'certificate-icon']) ?>
            <?= FileManagerWidget::widget([
                                              'uploadUrl' => Url::to(['upload-picture']),
                                              'removeUrl' => Url::to(['remove-picture']),
                                              'maxFiles' => 1,
                                              'targetInputId' => 'certificate-icon',
                                              'files' => $model->icon
                                          ]) ?>
                <div class="form-group">
            <?= ($model->isNewRecord) ? Html::submitButton('Создать Сертификат',
                                                           ['class' => 'btn btn-success']) : Html::submitButton('Обновить Сертификат',
                                                                                                                ['class' => 'btn btn-primary']) ?>
                </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
