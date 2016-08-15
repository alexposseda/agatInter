<?php
    use yii\helpers\Html;
    use yii\helpers\HtmlPurifier;

    /** @var \common\models\TrafficItem $model */
    if(isset($model->cover)){
        $model->cover = json_decode($model->cover);
        $image = Yii::$app->params['storage']['url'].DIRECTORY_SEPARATOR.'traffic'.DIRECTORY_SEPARATOR.$model->category->id.DIRECTORY_SEPARATOR.$model->id.DIRECTORY_SEPARATOR.$model->cover[0];
    }else{
        $image = Yii::$app->params['storage']['url'].'traffic/'.$model->category->id.'/'.json_decode($model->category->cover)[0];
    }
?>

<div class="traffic-item">
    <img src="<?= $image ?>" alt="img">
    <h2><?= Html::a($model->title, ['//traffic-item/view', 'id' => $model->id]) ?></h2>
    <?= HtmlPurifier::process($model->description) ?>
</div>