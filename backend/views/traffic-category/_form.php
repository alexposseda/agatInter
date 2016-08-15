<?php

    use backend\widgets\uploadPictureWidget\UploadPictureWidget;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TrafficCategory */
/* @var $form yii\widgets\ActiveForm */

    $uploadedPictures = Yii::$app->session->get('uploadedPictures');
    if(!$model->isNewRecord){
        $uploadedPictures[] = 'traffic/'.$model->id.'/'.json_decode($model->cover)[0];
    }
?>

<div class="traffic-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= Html::activeHiddenInput($model, 'cover', ['id' => 'category-cover']) ?>
    <?= UploadPictureWidget::widget([
                                        'uploadUrl' => Url::to(['traffic-category/upload-picture']),
                                        'removeUrl' => Url::to(['traffic-category/remove-picture']),
                                        'targetInputId' => 'category-cover',
                                        'pictures' => $uploadedPictures
                                    ]) ?>

    <?= $form->field($model, 'map')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
