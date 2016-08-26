<?php

    use yii\helpers\Html;

    /* @var $this yii\web\View */
    /* @var $model common\models\TrafficItem */

    $this->title = 'Редактировать: '.$model->title;
    $this->params['breadcrumbs'][] = ['label' => 'Перевозки', 'url' => ['traffic/index', 'SearchTrafficItem[categoryId]'=>$model->categoryId]];
    $this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['item-view', 'id' => $model->id]];
    $this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="traffic-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formItem', [
        'model' => $model,
    ]) ?>

</div>
