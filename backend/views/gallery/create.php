<?php
    use yii\helpers\Html;

    /**
     * @var yii\web\View                $this
     * @var \backend\models\GalleryModel $model
     */
    $this->title = 'Создать Категорию Галереи';
    $this->params['breadcrumbs'][] = ['label' => 'Галерея', 'url' => ['gallery/index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>