<?php
    /**
     * @var \yii\web\View               $this
     * @var \common\models\GalleryModel $model
     */
    use backend\assets\GalleryAsset;
    use yii\alexposseda\fileManager\FileManager;
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Html;
    use yii\helpers\Url;

    GalleryAsset::register($this);
    $uploadUrl = Url::to(['upload-picture']);
    $removeUrl = Url::to(['remove-picture']);
    $script = <<<JS
var gallerySetting = {
    uploadUrl: "{$uploadUrl}",
    removeUrl: "{$removeUrl}"
};
uploadHandler();
removeHandler();
replaceHandler();
JS;
    $this->registerJs($script, \yii\web\View::POS_END);
    $notSavedPictures = FileManager::getFilesFromSession();
?>

<div class="gallery-form">
    <?php $form = ActiveForm::begin() ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= $form->field($model->categoryModel, 'title')->label(false)
                     ->input('text', ['placeholder' => 'Название']) ?>
        </div>
        <div class="panel-body gallery">
            <div id="gallery-message">
                <?php if(empty($model->items)): ?>
                    <div class="alert alert-info">Нет загруженных фотографий для данной категории</div>
                <?php endif; ?>
            </div>
            <?php if(!empty($notSavedPictures)): ?>
                <div class="panel panel-danger" id="notSaved">
                    <div class="panel-heading">Не сохраненные фотографии</div>
                    <div class="panel-body" id="gallery-notSaved">
                        <?php foreach($notSavedPictures as $picture): ?>
                            <div class="gallery-notsaved-item col-lg-3">
                                <div class="panel panel-success">
                                    <div class="panel-body">
                                        <img src="<?= FileManager::getInstance()->getStorageUrl().$picture ?>"
                                             class="img-responsive img-thumbnail">
                                    </div>
                                    <div class="panel-footer">
                                        <button class="btn btn-sm btn-danger pull-right removeBtn"
                                                data-path="<?= $picture ?>">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        <button class="btn btn-sm btn-success pull-right replaceBtn"
                                                data-path="<?= $picture ?>">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="gallery-contentBox row" id="gallery">
                <?php
                    if(!empty($model->items)):
                        foreach($model->items as $index => $item):
                            ?>
                            <div class="gallery-item col-lg-3">
                                <div class="panel panel-success">
                                    <div class="panel-body">
                                        <button class="btn btn-sm btn-danger pull-right removeBtn"
                                                data-path="<?= $item->picture?>">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        <img src="<?= FileManager::getInstance()->getStorageUrl().$item->picture ?>"
                                             class="img-responsive img-thumbnail">
                                    </div>
                                    <div class="panel-footer">
                                        <?= Html::activeTextarea($item, [$index].'description', ['class'=>'form-control'])?>
                                        <?= Html::activeHiddenInput($item, [$index].'picture')?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    endif;
                ?>
            </div>
            <div class="gallery-newItemBtn-wrap">
                <?= Html::fileInput(FileManager::getInstance()->getAttributeName(), null,
                                    ['class' => 'gallery-newItemBtn', 'id' => 'gallery-fileInput']) ?>
                <?= Html::label('<span class="glyphicon glyphicon-plus"></span>', 'gallery-fileInput',
                                ['class' => 'btn btn-large btn-primary']) ?>
            </div>
            <div class="gallery-preloader" id="gallery-preloader">
                <span>Loading...</span>
            </div>
        </div>
        <div class="panel-footer">
            <?= Html::submitButton($model->categoryModel->isNewRecord ? 'Создать' : 'Обновить',
                                   ['class' => $model->categoryModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>
