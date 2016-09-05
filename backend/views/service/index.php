<?php
    use yii\alexposseda\fileManager\FileManager;
    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\widgets\Pjax;

    /* @var $this yii\web\View */
    /* @var $searchModel backend\models\ServiceSearch */
    /* @var $dataProvider yii\data\ActiveDataProvider */
    $this->title = 'Services';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Service', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
                                                        'dataProvider' => $dataProvider,
                                                        'filterModel' => $searchModel,
                                                        'columns' => [
                                                            ['class' => 'yii\grid\SerialColumn'],
                                                            'id',
                                                            'title',
                                                            'short_description:ntext',
                                                            [
                                                                'attribute' => 'icon',
                                                                'content' => function($date){
                                                                    return '<img src="'.FileManager::getInstance()
                                                                                                   ->getStorageUrl().json_decode($date->icon)[0].'">';
                                                                }
                                                            ],
                                                            ['class' => 'yii\grid\ActionColumn'],
                                                        ],
                                                    ]); ?>
    <?php Pjax::end(); ?></div>
