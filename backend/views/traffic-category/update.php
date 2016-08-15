<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TrafficCategory */

$this->title = 'Update Traffic Category: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Traffic Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="traffic-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
