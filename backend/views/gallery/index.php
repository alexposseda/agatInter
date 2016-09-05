<?php
    /**
     * @var \yii\web\View                      $this
     * @var \common\models\GalleryCategory[]   $galleryCategories
     * @var \backend\models\SearchGalleryItems $searchModel
     * @var \yii\data\ActiveDataProvider       $dataProvider
     */
    use yii\bootstrap\Html;
    use yii\widgets\ListView;
    use yii\widgets\Pjax;

?>
<?php Pjax::begin() ?>
<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Категории</h2>
            </div>
            <div class="panel-body">
                <div class="row text-center">
                    <?= Html::a('Создать Категорию', ['gallery/create'], [
                        'class' => 'btn btn-success',
                        'data-pjax' => 0
                    ]) ?>
                </div>
                <br>
                <div class="list-group">
                    <?php
                        if($galleryCategories):
                            $count = 0;
                            foreach($galleryCategories as $category):
                                $activeCssClass = '';
                                if(empty(Yii::$app->request->get('categoryId')) && $count == 0){
                                    $activeCssClass = ' active';
                                    $count++;
                                }
                                if($category->id == Yii::$app->request->get('categoryId')){
                                    $activeCssClass = ' active';
                                }
                                ?>
                                <?= Html::a($category->title, [
                                'gallery/index',
                                'categoryId' => $category->id
                            ], ['class' => 'list-group-item'.$activeCssClass]); ?>
                                <?php
                            endforeach;
                        else:
                            ?>
                            <div class="alert alert-warning"><strong>Не найдено ни одной категории</strong></div>
                            <?php
                        endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-8 col-lg-9">
        <?php if($searchModel->category): ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="pull-right">
                    <?= Html::a('Редактировать', [
                        'gallery/update',
                        'id' => $searchModel->category->id
                    ], [
                                    'class' => 'btn btn-warning',
                                    'data-pjax' => 0
                                ]) ?>
                    <?= Html::a('Удалить', [
                        'gallery/delete',
                        'id' =>  $searchModel->category->id
                    ], [
                                    'class' => 'btn btn-danger',
                                    'data' => ['confirm' => 'Вы уверены?', 'method' => 'post'],

                                ]) ?>
                </div>
                <h2 class="panel-title"><?= $searchModel->category->title?></h2>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <?= ListView::widget([
                                         'dataProvider' => $dataProvider,
                                         'itemView' => '_item',
                                         'layout' => "<div class='row'>\n{items}\n</div>\n{pager}",
                                         'emptyText' => 'Фотограйии не найдены',
                                         'emptyTextOptions' => [
                                             'tag' => 'div',
                                             'class' => 'alert alert-warning'
                                         ]
                                     ]) ?>
            </div>
        </div>
        <?php else: ?>
            <div class="alert alert-warning"><strong>Нет данных для данной категории</strong></div>
        <?php endif; ?>
    </div>
</div>
<?php Pjax::end()?>
