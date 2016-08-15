<?php

    use backend\models\SearchTrafficItem;
    use yii\widgets\ListView;

    /** @var \yii\data\ActiveDataProvider $dataProvider */
    /** @var SearchTrafficItem $searchModel */

?>

<?= ListView::widget([
                         'dataProvider' => $dataProvider,
                         'itemView'     => '_item',
                     ]) ?>
