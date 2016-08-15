<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TrafficItem */

$this->title = 'Create Traffic Item';
$this->params['breadcrumbs'][] = ['label' => 'Traffic Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="traffic-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
