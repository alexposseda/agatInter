<?php
    /**
     * @var \yii\web\View $this
     */
    use yii\bootstrap\Html;

?>

<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">

                <h2 class="panel-title">Категории</h2>
            </div>
            <div class="panel-body">
                <?= Html::a('Создать', ['gallery/create'], ['class'=>'btn btn-success'])?>
                <div class="list-group">
                <!-- todo add category list -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-8 col-lg-9">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="pull-right">
                    <?= Html::a('Редактировать', ['gallery/update'], ['class'=>'btn btn-warning'])?>
                    <?= Html::a('Удалить', ['gallery/delete'], ['class'=>'btn btn-danger'])?>
                </div>
                <h2 class="panel-title">Gallery Title</h2>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
            <!--  todo add list view  -->
            </div>
        </div>
    </div>
</div>
