<?php
    /**
     * @var \yii\web\View $this
     */
    $this->registerJs('$(".slider").slider({full_width: true});');
?>
<div class="slider fullscreen">
    <ul class="slides">
        <li>
            <img src="http://lorempixel.com/580/250/nature/1">
            <div class="caption right-align">
                <h3>Header 1</h3>
                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
            </div>
        </li>
        <li>
            <img src="http://lorempixel.com/580/250/nature/2">
            <div class="caption right-align">
                <h3>Right Aligned Caption</h3>
                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
            </div>
        </li>
        <li>
            <img src="http://lorempixel.com/580/250/nature/3">
            <div class="caption right-align">
                <h3>Header 4</h3>
                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
            </div>
        </li>
    </ul>
</div>
