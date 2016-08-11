<?php

    /* @var $this yii\web\View */
    /* @var $form yii\bootstrap\ActiveForm */
    /* @var $model \frontend\models\ResetPasswordForm */

    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = 'Reset password';
    $this->params['breadcrumbs'][] = $this->title;

    $script = <<<JS
$('.showPass').mousedown(function(){
    $(this).prev().attr('type', 'text');
});
$('.showPass').mouseup(function(){
    $(this).prev().attr('type', 'password');
});
JS;
    $this->registerJs($script, \yii\web\View::POS_END);

    $style = <<<CSS
.showPass{
cursor: pointer;
}
CSS;
    $this->registerCss($style);
?>
<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please choose your new password:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                                                'fieldConfig' => [
                                                    'template' => "{label}\n<div class='input-group'>\n{input}\n<span class='input-group-addon showPass'><span class='glyphicon glyphicon-eye-open'</span></span>\n</div>\n{hint}\n{error}"
                                                ],
                                                'id' => 'reset-password-form'
                                            ]); ?>

            <?= $form->field($model, 'password_repeat')
                     ->passwordInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')
                     ->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
