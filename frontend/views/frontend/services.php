<?php
    /**
     * @var \yii\web\View          $this
     * @var array                  $services    Services::find()->asArray()->all();
     * @var \common\models\Service $serviceItem ;
     */
    use frontend\assets\SlickAsset;
    use yii\alexposseda\fileManager\FileManager;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

    SlickAsset::register($this);
?>

<div class="mainBox fullH mainBox-pictureContainer">
    <div class="background">
        <img src="<?= Url::to('/img/pexels-photo-122164.jpeg', true) ?>" class="background-img">
        <div class="shadow"></div>
    </div>
    <div class="row no-marg-bot fullHeight mainBox-content">
        <div class="col s6 white fullHeight vertical-slider-scrollZone">
            <div class="valign-wrapper fullHeight">
                <div class="valign fullWidth">
                    <?php if(!empty($services)): ?>
                        <div class="vertical-slider">
                            <?php foreach($services as $service): ?>
                                <div class="vertical-slider-item <?= ($service['id'] == Yii::$app->request->get('id')) ? 'active' : ''?>">
                                    <a href="<?= Url::to(['services', 'id' => $service['id']]) ?>">
                                        <div class="service row no-marg-bot">
                                            <div class="col s2 offset-s1 service-icon right-align">
                                                <br>
                                                <img src="<?= FileManager::getInstance()
                                                                         ->getStorageUrl().json_decode($service['icon'])[0] ?>"
                                                     class="responsive-img">
                                            </div>
                                            <div class="col s8 service-content">
                                                <h4><?= $service['title'] ?></h4>
                                                <p><?= $service['short_description'] ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="card-panel teal lighten-2">Не найдено ни одного вида перевозки</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col s6 fullHeight relative no-padding">
            <?php if(is_null($serviceItem)):?>
            <div class="valign-wrapper center fullHeight" id="baseContent">
                <div class="valign white-text fullWidth">
                    <h2>Услуги</h2>
                    <h5>Полный спектр услуг,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;которые мы предоставляем</h5>
                </div>
            </div>
            <?php endif;?>
            <?php Pjax::begin(['id' => 'content', 'options' => ['class' => 'fullHeight service-wrap']]) ?>
            <?php if(!is_null($serviceItem)): ?>
                <?= $this->render('_serviceItem', ['serviceItem' => $serviceItem]) ?>
            <?php endif; ?>
            <?php Pjax::end() ?>
            <div id="preloader" class="valign-wrapper fullHeight">
                <div class="preloader-content valign fullWidth">
                    <div class="preloader-item">
                        <div class="preloader-wrapper big active outer">
                            <div class="spinner-layer spinner-blue">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                            <div class="spinner-layer spinner-red">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                            <div class="spinner-layer spinner-yellow">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                            <div class="spinner-layer spinner-green">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="preloader-item">
                        <div class="preloader-wrapper active inner">
                            <div class="spinner-layer spinner-blue">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                            <div class="spinner-layer spinner-red">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                            <div class="spinner-layer spinner-yellow">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                            <div class="spinner-layer spinner-green">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="preloader-item">
                        <div class="preloader-wrapper small active inner">
                            <div class="spinner-layer spinner-blue">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                            <div class="spinner-layer spinner-red">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                            <div class="spinner-layer spinner-yellow">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                            <div class="spinner-layer spinner-green">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php
    $this->registerJs('
        jQuery(document).pjax(".vertical-slider a", "#content", {"push":true,"replace":false,"timeout":1000,"scrollTo":false});
        $(document).on("pjax:start", function(){
            $("#baseContent").hide();
            $("#preloader").show();
        });
        $(document).on("pjax:end", function(){
            $("#preloader").hide();
        })
    ');
?>

