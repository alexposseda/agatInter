<?php
    /**
     * @var \yii\web\View $this
     * @var \backend\models\SettingMailForm $settingMailForm
     * @var \backend\models\SettingPersonalForm $settingPersonalForm
     */
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Html;
    use yii\helpers\ArrayHelper;
    use yii\widgets\Pjax;

    $this->title = 'АгатИнтер | Настройки';
    $this->params['breadcrumbs'][] = 'Настройки';
    $script = <<<JS
$('.form-control').change(function(){
    $(this).parents('form').find('button[type=submit]').removeAttr('disabled');
});
JS;

    $this->registerJs($script, \yii\web\View::POS_END);
?>

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Персональные настройки</div>
                <div class="panel-body">
                    <?php Pjax::begin(['enablePushState' => false]) ?>
                    <?php $personalForm = ActiveForm::begin() ?>
                    <?php
                        if($settingPersonalForm->hasErrors()):
                            ?>
                            <div class="alert alert-warning">
                                <?php foreach($settingPersonalForm->getErrors() as $fieldName => $errors): ?>
                                    <p><strong><?= $settingPersonalForm->getAttributeLabel($fieldName) ?>
                                            : </strong> <?= implode(',', $errors) ?></p>
                                <?php endforeach; ?>
                            </div>
                            <?php
                        else:
                            if(isset($successMessage['personalForm'])):
                                ?>
                                <div class="alert alert-success"><?= $successMessage['personalForm'] ?></div>
                                <?php
                            endif;
                        endif;
                    ?>
                    <?= $personalForm->field($settingPersonalForm, 'email')
                                     ->input('email', ['placeholder' => 'example@mail.com']) ?>
                    <div class="text-center">
                        <?= Html::submitButton(
                            'Применить изменения',
                            ['class' => 'btn btn-warning', 'disabled' => true]
                        ) ?>
                    </div>
                    <?php ActiveForm::end() ?>
                    <?php Pjax::end() ?>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default" id="passwordPanel">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#passwordPAnel" href="#passwordBox" class="panel-title">Изменить пароль</a>
                </div>
                <div class="panel-body collapse" id="passwordBox">
                    here is password firm
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">Настройки почты</div>
            <div class="panel-body">
                <?php Pjax::begin(['enablePushState' => false]) ?>
                <?php $mailForm = ActiveForm::begin(
                    [
                        'options' => [
                            'data-pjax' => true
                        ]
                    ]
                ) ?>
                <?php
                    if($settingMailForm->hasErrors()):
                        ?>
                        <div class="alert alert-warning">
                            <?php foreach($settingMailForm->getErrors() as $fieldName => $errors): ?>
                                <p><strong><?= $settingMailForm->getAttributeLabel($fieldName) ?>
                                        : </strong> <?= implode(',', $errors) ?></p>
                            <?php endforeach; ?>
                        </div>
                        <?php
                    else:
                        if(isset($successMessage['mailForm'])):
                            ?>
                            <div class="alert alert-success"><?= $successMessage['mailForm'] ?></div>
                            <?php
                        endif;
                    endif; ?>
                <?= $mailForm->field($settingMailForm, 'supportMail')
                             ->input('email', ['placeholder' => 'example@mail.com']) ?>
                <?= $mailForm->field($settingMailForm, 'robotMail')
                             ->input('email', ['placeholder' => 'example@mail.com']) ?>
                <div class="text-center">
                <?= Html::submitButton(
                    'Применить изменения',
                    ['class' => 'btn btn-warning', 'disabled' => true]
                ) ?>
                </div>
                <?php ActiveForm::end() ?>
                <?php Pjax::end() ?>
            </div>
        </div>
    </div>
</div>
