<?php
    /**
     * @var \yii\web\View                $this
     * @var string                       $action
     * @var \backend\models\GalleryModel $galleryModel
     */
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Html;
    use yii\helpers\Url;
    use yii\web\View;

    $script = 'var uploadUrl = "'.Url::to(['gallery/upload-picture']).'";var removeUrl="'.Url::to(['gallery/remove-picture']).'";';

    $this->registerJs($script, View::POS_END);
?>


<div class="row">
    <div class="col-sm-12 col-md-8 col-lg-8">
        <?php $form = ActiveForm::begin() ?>
        <div class="panel panel-info">
            <div class="panel-heading">
                <?= $form->field($galleryModel, 'galleryCategoryTitle') ?>
            </div>
            <div class="panel-body">
                <div class="alert alert-warning">Нет загруженных фотографий</div>
                <div id="gallery">
                    <div class="gallery-item">
                        <div class="actions">
                            <button type="button" class="btn btn-danger">
                                <span class="glyphicon glyphicon-remove"></span>
                            </button>
                        </div>
                        <div class="picture">
                            <img src="">
                            <input type="hidden">
                        </div>
                        <textarea class="description">description</textarea>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <?= ($action == 'create') ? Html::submitButton('Создать Категорию',
                                                               ['class' => 'btn btn-success']) : Html::submitButton('Обновить Категорию',
                                                                                                                    ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4">
        <div class="panel panel-success">
            <div class="panel-heading">Добавить фото в галерею</div>
            <div class="panel-body">
                <div class="photo-prev">
                    <div id="picture-preview">

                    </div>
                    <div id="preloader" class="preloader" style="display: none">
                        <span>loading ...</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="picture">Фото</label>
                    <?= Html::fileInput('picture', null, ['class' => 'form-control', 'id' => 'picture']) ?>
                    <div class="hint-block"></div>
                </div>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <?= Html::textarea('description', null, ['class' => 'form-control', 'id' => 'description']) ?>
                </div>
            </div>
            <div class="panel-footer text-center">
                <?= Html::button('Добавить', ['class' => 'btn btn-success', 'id' => 'addToGallery']) ?>
                <?= Html::button('Очистить', ['class' => 'btn btn-warning', 'id'=>'removePicture']) ?>
            </div>
        </div>
    </div>
</div>

