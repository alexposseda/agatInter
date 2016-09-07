<?php

use yii\db\Migration;
    /**
     * Handles adding coordinates and icon to table `traffic_item`.
     */
class m160907_085513_add_columns_to_traffic_item_table extends Migration
{
    public function up()
    {
        $this->addColumn('agi_traffic_item', 'coordinates', $this->string());
        $this->addColumn('agi_traffic_item', 'iconId', $this->integer());

        $this->createIndex('trafficItemIconId', 'agi_traffic_item', 'iconId');

    }

    public function down()
    {
        $this->dropColumn('agi_traffic_item', 'coordinates');
        $this->dropColumn('agi_traffic_item', 'icon');
    }
}
