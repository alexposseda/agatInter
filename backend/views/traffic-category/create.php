<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TrafficCategory */

$this->title = 'Create Traffic Category';
    $this->params['breadcrumbs'][] = ['label' => 'Traffic', 'url' => ['//traffic/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="traffic-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
