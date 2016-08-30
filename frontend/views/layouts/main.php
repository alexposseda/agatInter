<?php
    /* @var $this \yii\web\View */
    /* @var $content string */
    use common\models\GalleryCategory;
    use common\models\TrafficCategory;
    use frontend\assets\AppAsset;
    use common\widgets\Alert;
    use frontend\widgets\SideMenuWidget\SideMenuWidget;
    use macgyer\yii2materializecss\lib\Html;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Url;

    AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header>
    <?= SideMenuWidget::widget([
                                   'menuItems' => [
                                       [
                                           'label' => '<img src="'.Url::to('/img/logo.png',
                                                                           true).'" class="responsive-img">',
                                           'labelOptions' => ['class'=>'brand-logo', 'id'=> 'logo-container'],
                                           'url' => ['frontend/index']
                                       ],
                                       [
                                           'label' => 'Услуги',
                                            'url' => ['frontend/services']
                                       ],
                                       [
                                           'label' => 'Виды перевозок',
                                           'url' => ['frontend/traffic'],
                                           'innerMenu' => [
                                               'items' => ArrayHelper::map(TrafficCategory::find()->all(), 'id', 'title'),
                                               'paramName' => 'id'
                                           ]
                                       ],
                                       [
                                           'label' => 'Галерея',
                                           'url' => ['frontend/gallery-category'],
                                           'innerMenu' => [
                                               'items' => ArrayHelper::map(GalleryCategory::find()->all(), 'id', 'title'),
                                               'paramName' => 'id'
                                           ]
                                       ],
                                       [
                                           'label' => 'Сертификаты',
                                           'url' => ['frontend/certificates'],
                                       ],
                                       [
                                           'label' => 'Контакты',
                                           'url' => ['frontend/contacts'],
                                       ],
                                       [
                                           'label' => 'О нас',
                                           'url' => ['frontend/about-us'],
                                       ],
                                   ]
                               ]) ?>
</header>
<main>
    <?= Alert::widget() ?>
    <?= $content ?>
</main>
<footer class="footer"></footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
