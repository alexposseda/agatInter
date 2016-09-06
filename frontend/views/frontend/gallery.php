<?php
    /**
     * @var \yii\web\View                  $this
     * @var \common\models\GalleryCategory $gallery
     */
    use backend\models\GalleryPictureModel;
    use frontend\assets\SlickAsset;
    use yii\alexposseda\fileManager\FileManager;
    use yii\helpers\Url;

    SlickAsset::register($this);
    $this->registerJsFile('/js/slick-gallery.settings.js', ['depends' => 'frontend\assets\SlickAsset']);
    $pictures = $gallery->galleryItems;

    $bg = Url::to('/img/pexels-photo-122164.jpeg', true);
    if(!is_null($pictures)){
        $bg = FileManager::getInstance()
                         ->getStorageUrl().$pictures[0]->picture;
    }
?>

<div class="page-content fullH">
    <div class="row fullHeight no-marg-bot">
        <div class="col s6 white fullHeight vertical-slider-scroll-zone no-pad">
            <div class="valign-wrapper">
                <div class="valign fullWidth">
                    <?php if(!is_null($pictures)): ?>
                        <div class="vertical-slider gallery-list">
                            <?php for($i = 0; $i < count($pictures); $i = $i + 2): ?>
                                <div class="vertical-slider-item gallery-item">
                                    <div class="gallery-item-container row">
                                        <div class="col s6">
                                            <div class="card">
                                                <div class="card-image">
                                                    <img src="<?= GalleryPictureModel::getThumb($pictures[$i]->picture) ?>" class="activator">
                                                </div>
                                                <?php if($pictures[$i]->description): ?>
                                                    <div class="card-reveal">
                                                        <span class="card-title"><i class="material-icons right">close</i></span>
                                                        <p><?= $pictures[$i]->description ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php if($pictures[$i + 1]): ?>
                                            <div class="col s6">
                                                <div class="card">
                                                    <div class="card-image">
                                                        <img src="<?= GalleryPictureModel::getThumb($pictures[$i + 1]->picture) ?>" class="activator">
                                                    </div>
                                                    <?php if($pictures[$i + 1]->description): ?>
                                                        <div class="card-reveal">
                                                            <span class="card-title"><i class="material-icons right">close</i></span>
                                                            <p><?= $pictures[$i + 1]->description ?></p>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <div class="col s10 offset-s1">
                                <div class="card-panel">Ни одной фотографии не найдено....</div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col s6 fullHeight zone-right no-pad">
            <div class="valign-wrapper">
                <div class="valign white-text fullWidth fullHeight">
                    <?php if(!is_null($pictures)): ?>
                        <div class="vertical-slider gallery-big">
                            <?php for($i = 0; $i < count($pictures); $i = $i + 2): ?>
                                <div class="vertical-slider-item gallery-item fullH">
                                    <div class="card">
                                        <div class="card-image">
                                            <img data-lazy="<?= GalleryPictureModel::getBase($pictures[$i]->picture) ?>"
                                                 class="responcive-img" <?= ($pictures[$i]->description) ? 'data-caption="'.$pictures[$i]->description.'"' : '' ?>>
                                        </div>
                                    </div>
                                    <?php if($pictures[$i + 1]): ?>
                                        <div class="card">
                                            <div class="card-image">
                                                <img data-lazy="<?= GalleryPictureModel::getBase($pictures[$i+1]->picture) ?>"
                                                     class="responcive-img" <?= ($pictures[$i + 1]->description) ? 'data-caption="'.$pictures[$i + 1]->description.'"' : '' ?>>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endfor; ?>
                        </div>
                    <?php else: ?>
                        <p class="title center-align">Наша галерея</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-wrap">
    <img src="<?= $bg ?>" alt="" class="bg-picture">
    <div class="bg-shadow"></div>
</div>
<div class="big-picture-container" id="big-picture">
    <div class="big-picture">
        <img src="#">
    </div>
    <div class="big-picture-description"></div>
</div>
