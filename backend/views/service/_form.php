<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    /* @var $this yii\web\View */
    /* @var $model common\models\Service */
    /* @var $form yii\widgets\ActiveForm */
?>

<div class="service-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')
             ->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_description')
             ->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'full_description')
             ->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'icon')
             ->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

</div>
