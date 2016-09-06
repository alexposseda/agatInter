<?php
    /**
     * @var \yii\web\View              $this
     * @var array                      $certificates    Certificates::find()->asArray()->all();
     * @var \common\models\Certificate $certificateItem ;
     */
    use backend\models\CertificateUploadModel;
    use frontend\assets\SlickAsset;
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
                        <div class="vertical-slider certificate-slider">
                            <?php foreach($certificates as $certificate): ?>
                                <div
                                    class="vertical-slider-item certificate <?= ($certificate['id'] == Yii::$app->request->get('id')) ? 'active' : '' ?>">
                                    <a href="<?= Url::to([
                                                             'certificates',
                                                             'id' => $certificate['id']
                                                         ]) ?>" class="certificate-link card horizontal certificate-small">
                                            <div class="card-image">
                                                <img src="<?= CertificateUploadModel::getThumb(json_decode($certificate['icon'])[0]) ?>">
                                            </div>
                                            <div class="card-stacked">
                                                <div class="card-title"><?= $certificate['title']?></div>
                                                <div class="card-content">
                                                    <?= $certificate['short_description'] ?>
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
                <?= $this->render('_certificateItem', ['certificateItem' => $certificateItem]) ?>
            <?php else: ?>
                <div class="valign-wrapper" id="baseContent">
                    <div class="valign white-text fullWidth">
                        <p class="title center-align">Наши сертификаты</p>
                    </div>
                </div>
            <?php endif; ?>
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

