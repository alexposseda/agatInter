<?php
    use backend\widgets\uploadPictureWidget\UploadPictureWidget;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;

    /** @var \common\modules\Storage\models\StorageModel $model */

    $uploadedPictures = Yii::$app->session->get('picture');
    if(!$model->isNewRecord){
        $covers = json_decode($model->cover);
        foreach($covers as $cover){
            $uploadedPictures[] = 'traffic/'.$model->categoryId.'/'.$model->id.'/'.$cover;
        }

    }
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= Html::activeHiddenInput($model, 'cover', ['id' => 'service-icon']) ?>
<?= UploadPictureWidget::widget([
                                    'uploadUrl' => Url::to(['//storage/storage/upload']),
                                    'removeUrl' => Url::to(['//storage/storage/delete']),
                                    'targetInputId' => 'service-icon',
//                                    'pictures' => $uploadedPictures
                                    'picturesCount'=>3
                                ]) ?>

<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>
