<?php

    use yii\helpers\Html;


    /* @var $this yii\web\View */
    /* @var $model common\models\TrafficItem */

    $this->title = 'Создать транспорт';
    $this->params['breadcrumbs'][] = ['label' => 'Перевозки', 'url' => ['traffic/index', 'SearchTrafficItem[categoryId]'=>$model->categoryId]];
    $this->params['breadcrumbs'][] = $this->title;

?>
<div class="traffic-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formItem', [
        'model' => $model,
    ]) ?>

</div>
