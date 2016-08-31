<?php
    /**
     * @var \yii\web\View $this
     */
    use yii\helpers\Url;

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
                    <h2>АгатИнтер</h2>
                    <p>Phone</p>
                </div>
            </div>
        </div>
        <div class="col s6 fullHeight relative no-padding">
            <div class="valign-wrapper center fullHeight" id="baseContent">
                <div class="valign white-text fullWidth">
                    <h2>Услуги</h2>
                    <h5>Полный спектр услуг,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;которые мы предоставляем</h5>
                </div>
            </div>
        </div>

    </div>
</div>


