<?php

    use yii\helpers\Html;

    /* @var $this yii\web\View */
    /* @var $model common\models\TrafficCategory */

    $this->title = 'Редактировать: ' . $model->title;
    $this->params['breadcrumbs'][] = ['label' => 'Перевозки', 'url' => ['/traffic/index']];
    $this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['/traffic/index', 'categoryId' => $model->id]];
    $this->params['breadcrumbs'][] = 'Update';
?>
<div class="traffic-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formCategory', [
        'model' => $model,
    ]) ?>

</div>
