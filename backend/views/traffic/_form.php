<?php
    /**
     * @var \yii\web\View               $this
     * @var \common\models\TrafficModel $model
     */
    use backend\assets\MapAsset;
    use yii\bootstrap\ActiveForm;

    MapAsset::register($this);
?>

<?php $form = ActiveForm::begin() ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?= $form->field($model->trafficCategory, 'title')
                 ->label(false)
                 ->input('text', ['placeholder' => 'Введите название']) ?>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-7">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <p class="panel-title">Карта</p>
                    </div>
                    <div class="panel-body">
                        <div class="map-wrapper">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="panel panel-success">
                    <div class="panel-heading">Обьекты</div>
                    <div class="panel-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>
