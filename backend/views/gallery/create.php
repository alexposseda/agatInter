<?php
    use backend\assets\GalleryAsset;
    use yii\bootstrap\Html;

    /**
     * @var \yii\web\View $this
     * @var \backend\models\GalleryModel $galleryModel;
     */

    $this->title = 'Create Gallery Category';
    $this->params['breadcrumbs'][] = ['label' => 'Gallery', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;

    GalleryAsset::register($this);
?>

<div class="gallery-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', ['galleryModel' => $galleryModel, 'action' => 'create'])?>
</div>
