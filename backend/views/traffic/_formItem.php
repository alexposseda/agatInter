<?php
    use backend\widgets\FileManagerWidget\FileManagerWidget;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;

    /* @var $this yii\web\View */
    /* @var $model common\models\TrafficItem */
    /* @var $form yii\widgets\ActiveForm */


?>

<div class="traffic-item-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-12 col-md-7 col-lg-7">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-sm-12 col-md-5 col-lg-5">
            <?= Html::activeHiddenInput($model, 'cover', ['id' => 'item-cover']) ?>
            <?= FileManagerWidget::widget([
                                              'uploadUrl' => Url::to(['item-upload-cover']),
                                              'removeUrl' => Url::to(['item-remove-cover']),
                                              'maxFiles' => 10,
                                              'targetInputId' => 'item-cover',
                                              'files' => $model->cover
                                          ]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
