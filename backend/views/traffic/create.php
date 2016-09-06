<?php
    /**
     * @var \yii\web\View $this
     * @var \common\models\TrafficModel $model
     */

    use yii\bootstrap\Html;

    $this->title = 'Создать Вид перевозки';
    $this->params['breadcrumbs'][] = ['label' => 'Перевозки', 'url' => ['traffic/index']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="gallery-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
