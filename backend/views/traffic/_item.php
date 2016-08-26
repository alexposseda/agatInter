<?php
    use yii\alexposseda\fileManager\FileManager;
    use yii\bootstrap\Html;
    use yii\helpers\HtmlPurifier;

    /** @var \common\models\TrafficItem $model */
?>
<div class="col-sm-12 col-md-6 col-lg-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title text-center"><?= Html::a($model->title, ['item-view', 'id' => $model->id], ['data-pjax'=>0]) ?></h4>
        </div>
        <div class="panel-body">
            <?= Html::img(FileManager::getInstance()->getStorageUrl().json_decode($model->cover)[0], ['class'=> 'img-responsive'])?>
            <?= HtmlPurifier::process($model->description) ?>
        </div>
        <div class="panel-footer">
            <?= Html::a('Редактировать', ['item-update', 'id'=>$model->id], ['class'=>'btn btn-primary', 'data-pjax'=>0])?>
            <?= Html::a('Удалить', ['item-delete', 'id'=>$model->id], ['class'=>'btn btn-danger', 'data'=>['confirm'=>'Вы уверены?', 'method'=>'post']])?>
        </div>
    </div>
</div>