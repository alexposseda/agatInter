<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TrafficItem */

$this->title = $model->title;
    $this->params['breadcrumbs'][] = ['label' => 'Traffic', 'url' => ['//traffic/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="traffic-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'categoryId',
            'title',
            'cover',
            'description:ntext',
        ],
    ]) ?>

</div>
