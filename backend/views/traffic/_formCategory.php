<?php ;
    use backend\widgets\FileManagerWidget\FileManagerWidget;
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
    <div class="row">
        <div class="col-sm-12 col-md-7 col-lg-8">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-sm-12 col-md-5 col-lg-4">
            <?= Html::activeHiddenInput($model, 'cover', ['id' => 'category-cover']) ?>
            <?= FileManagerWidget::widget([
                                              'uploadUrl' => Url::to(['category-upload-cover']),
                                              'removeUrl' => Url::to(['category-remove-cover']),
                                              'maxFiles' => 1,
                                              'targetInputId' => 'category-cover',
                                              'files' => $model->cover
                                          ]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить',
                               ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
