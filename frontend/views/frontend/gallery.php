<?php
    /**
     * @var \yii\web\View                  $this
     * @var \common\models\GalleryCategory $gallery
     */
    use frontend\assets\GalleryAsset;
    use yii\alexposseda\fileManager\FileManager;

    GalleryAsset::register($this);
    $pictures = $gallery->galleryItems;
?>

<div class="mainBox fullH mainBox-pictureContainer">
    <?php
        $bg = 'null';
        if(!is_null($pictures)){
            $bg = FileManager::getInstance()->getStorageUrl().$pictures[0]->picture;
        }
    ?>
    <div class="background">
        <img src="<?= $bg ?>" class="background-img">
        <div class="shadow"></div>
    </div>
    <div class="row no-marg-bot fullHeight mainBox-content">
        <div class="col s6 white fullHeight vertical-slider-scrollZone">
            <div class="valign-wrapper fullHeight">
                <div class="valign fullWidth">
                    <?php if(!is_null($pictures)): ?>
                        <div class="vertical-slider gallery-wrap" id="gallerySmall">
                            <?php for(
                                $i = 0;
                                $i < count($pictures);
                                $i = $i + 2
                            ): ?>
                                <div class="vertical-slider-item">
                                    <div class="gallery row">
                                        <div class="col s6">
                                            <img src="<?= FileManager::getInstance()
                                                                     ->getStorageUrl().$pictures[$i]->picture ?>"
                                                 class="responsive-img">
                                            <?= $pictures[$i]->description ?>
                                        </div>
                                        <div class="col s6">
                                            <img src="<?= FileManager::getInstance()
                                                                     ->getStorageUrl().$pictures[$i + 1]->picture ?>"
                                                 class="responsive-img">
                                            <?= $pictures[$i + 1]->description ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    <?php else: ?>
                        <div class="card-panel teal lighten-2">Нет фотграфий</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col s6 fullHeight">
            <?php if(!is_null($pictures)): ?>
                <div class="valign-wrapper fullHeight">
                    <div class="valign fullWidth">
                        <div class="big-vertical-slider" id="galleryBig">
                            <?php for($i = 0; $i < count($pictures); $i = $i+2):?>
                                <div class="big-vertical-slider-item">
                                    <div class="big-vertical-slider-item-picture">
                                        <img src="<?= FileManager::getInstance()
                                                                ->getStorageUrl().$pictures[$i]->picture ?>"
                                        class="responsive-img">
                                    </div>
                                    <div class="big-vertical-slider-item-picture">
                                        <img src="<?= FileManager::getInstance()
                                                                 ->getStorageUrl().$pictures[$i+1]->picture ?>"
                                             class="responsive-img">
                                    </div>
                                </div>
                            <?php endfor;?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
