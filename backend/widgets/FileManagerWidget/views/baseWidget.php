<?php
    use yii\alexposseda\fileManager\FileManager;

    /**
     * @var array $notSavedFiles
     * @var array $savedFiles
     */

?>
<div class="fmw-container panel panel-default" id="fmw">
    <div class="panel-heading">File manager Widget</div>
    <div class="panel-body fmw-content">
        <?php
            if(!empty($notSavedFiles)):
                ?>
                <div class="panel panel-danger fmw-notsaved">
                    <div class="panel-heading">Not Saved Files</div>
                    <div class="panel-body">
                        <div class="row fmw-notsaved-gallery">
                            <?php foreach($notSavedFiles as $file): ?>
                                <div class="col-lg-6 fmw-notsaved-item">
                                    <img src="<?= FileManager::getInstance()->getStorageUrl().$file ?>">
                                    <div class="fmw-actions">
                                        <button type="button" class="btn btn-danger fmw-removeBtn" data-path="<?= $file ?>">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        <button type="button" class="btn btn-success fmw-replaceBtn" data-path="<?= $file ?>">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php
            endif;
        ?>
        <div class="fmw-messageBox" id="fmw-messageBox">
            <?php if(empty($savedFiles)): ?>
                <div class="fmw-message alert alert-info">Нет загруженых файлов</div>
            <?php endif; ?>
        </div>
        <div class="fmw-galleryBox row" id="fmw-galleryBox">
            <?php
                if(!empty($savedFiles)):
                    foreach($savedFiles as $file):
                        ?>
                        <div class="col-lg-6 fmw-galleryBox-item">
                            <img src="<?= FileManager::getInstance()->getStorageUrl().$file?>">
                            <div class="fmw-actions">
                                <button type="button" class="btn btn-warning fmw-removeBtn" data-path="<?= $file?>">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </button>
                            </div>
                        </div>
                        <?php
                    endforeach;
                endif;
            ?>
        </div>
        <div class="fmw-preloader" id="fmw-preloader">
            <span>Loading....</span>
        </div>
    </div>
    <div class="panel-footer">
        <div class="form-group fmw-input">
            <input type="file" name="<?= FileManager::getInstance()->getAttributeName()?>" class="form-control" id="fmw-input">
        </div>
    </div>
</div>
