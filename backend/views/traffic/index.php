<?php

    use backend\models\SearchTrafficItem;
    use yii\helpers\Html;
    use yii\widgets\Pjax;

    /** @var SearchTrafficItem $searchModel */
    /** @var \yii\data\ActiveDataProvider $dataProvider */
    /** @var array $traffCategoryModel */

?>

<div class="row">

    <?php Pjax::begin() ?>
    <div class="col-lg-3">
        <?php
            foreach($traffCategoryModel as $category){
                echo '<p>'.Html::a($category->title, ['traffic/index', 'SearchTrafficItem[categoryId]' => $category->id]).'</p>';
            }
        ?>
    </div>

    <div class="col-lg-9">
        <h1>
            <img src="<?= Yii::$app->params['storage']['url'].'traffic/'.$searchModel->category->id.'/'.json_decode($searchModel->category->cover)[0] ?>" alt="">
            <?= $searchModel->category->title ?></h1>
        <p><?= $searchModel->category->description ?></p>
        <p>Map</p>

        <?= Html::a('Create Traffic Category', ['//traffic-category/create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Create Traffic Item', ['//traffic-item/create','categoryId'=>$searchModel->categoryId], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Edit Traffic Category', ['//traffic-category/update', 'id' => $searchModel->categoryId], ['class' => 'btn btn-success']) ?>

        <?= $this->render('//traffic-item/list', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]) ?>
    </div>
    <?php Pjax::end() ?>
</div>