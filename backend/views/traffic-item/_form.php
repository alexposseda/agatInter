<?php

    use backend\widgets\uploadPictureWidget\UploadPictureWidget;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TrafficItem */
/* @var $form yii\widgets\ActiveForm */

    $uploadedPictures = Yii::$app->session->get('uploadedPictures');
    if(!$model->isNewRecord){
        $covers = json_decode($model->cover);
        foreach($covers as $cover){
            $uploadedPictures[] = 'traffic/'.$model->categoryId.'/'.$model->id.'/'.$cover;
        }

    }

?>

<div class="traffic-item-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'categoryId')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= Html::activeHiddenInput($model, 'cover', ['id' => 'item-cover']) ?>
    <?= UploadPictureWidget::widget([
                                        'uploadUrl' => Url::to(['traffic-category/upload-picture']),
                                        'removeUrl' => Url::to(['traffic-category/remove-picture']),
                                        'targetInputId' => 'item-cover',
                                        'pictures' => $uploadedPictures,
                                        'picturesCount' =>3
                                    ]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
