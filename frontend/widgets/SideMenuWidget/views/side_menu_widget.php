<?php
    use macgyer\yii2materializecss\lib\Html;
    use yii\helpers\Url;

    /**
     * @var array $menuItems
     */
?>
<div class="general-nav" id="general-nav">
    <div class="menu-but" id="menu-but">
        <i class="material-icons">menu</i>
    </div>
    <div class="outer-nav outer-nav-offset" id="outer-nav">
        <div class="valign-wrapper fullHeight">
            <ul class="valign hidden">
                <?php foreach($menuItems as $item): ?>
                    <li>
                        <?= Html::a($item['label'], $item['url'], $item['labelOptions']) ?>
                        <?php
                            if(!empty($item['innerMenu']) and is_array($item['innerMenu']['items'])):
                                ?>
                                <div class="inner-nav">
                                    <div class="valign-wrapper fullHeight">
                                        <ul class="valign">
                                            <?php
                                                foreach($item['innerMenu']['items'] as $innerMenuItem):
                                                    ?>
                                                    <li class="inner-nav-item">
                                                        <?= Html::a($innerMenuItem['label'], $innerMenuItem['url'],
                                                                    $innerMenuItem['labelOptions']) ?>
                                                    </li>
                                                    <?php
                                                endforeach;
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php
                            endif;
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="general-nav-bg"></div>
    </div>
</div>
