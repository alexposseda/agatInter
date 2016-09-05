<?php
    /**
     * @var \yii\web\View              $this
     * @var array                      $certificates    Certificates::find()->asArray()->all();
     * @var \common\models\Certificate $certificateItem;
     */
    use frontend\assets\SlickAsset;
    use yii\alexposseda\fileManager\FileManager;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

    SlickAsset::register($this);
    $this->registerJsFile('/js/slick-service.settings.js', ['depends' => 'frontend\assets\SlickAsset'])
?>

<div class="page-content fullH">
    <div class="row fullHeight no-marg-bot">
        <div class="col s6 white fullHeight vertical-slider-scroll-zone no-pad">
            <div class="valign-wrapper">
                <div class="valign fullWidth">
                    <?php if(!empty($certificates)): ?>
                        <div class="vertical-slider">
                            <?php foreach($certificates as $certificate): ?>
                                <div class="vertical-slider-item service <?= ($certificate['id'] == Yii::$app->request->get('id')) ? 'active' : '' ?>">
                                    <a href="<?= Url::to([
                                                             'services',
                                                             'id' => $certificate['id']
                                                         ]) ?>" class="service-link">
                                        <div class="service-small row">
                                            <div class="service-icon">
                                                <img src="<?= FileManager::getInstance()
                                                                         ->getStorageUrl().json_decode($certificate['icon'])[0] ?>"
                                                     class="responsive-img">
                                            </div>
                                            <div class="service-content">
                                                <p class="service-title"><?= $certificate['title'] ?></p>
                                                <p class="service-description"><?= $certificate['short_description'] ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <div class="col s10 offset-s1">
                                <div class="card-panel">Ни одного сертификата не найдено....</div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col s6 fullHeight zone-right no-pad relative">
            <?php Pjax::begin([
                                  'id' => 'content',
                                  'options' => ['class' => 'fullHeight service-wrap']
                              ]) ?>
            <?php if(!is_null($certificateItem)): ?>
                <?= $this->render('_serviceItem', ['serviceItem' => $certificateItem]) ?>
            <?php else: ?>
                <div class="valign-wrapper" id="baseContent">
                    <div class="valign white-text fullWidth">
                        <p class="title center-align">Наши сертификаты</p>
                    </div>
                </div>
            <?php endif;?>
            <?php Pjax::end() ?>
            <div id="preloader" class="valign-wrapper">
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
<div class="bg-wrap">
    <img src="<?= Url::to('/img/pexels-photo-122164.jpeg', true) ?>" alt="" class="bg-picture">
    <div class="bg-shadow"></div>
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

