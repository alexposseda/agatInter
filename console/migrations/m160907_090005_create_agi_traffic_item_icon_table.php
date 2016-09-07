<?php

use yii\db\Migration;

/**
 * Handles the creation for table `agi_traffic_item_icon`.
 */
class m160907_090005_create_agi_traffic_item_icon_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('agi_traffic_item_icon', [
            'id' => $this->primaryKey(),
            'icon' => $this->text(),
        ]);

        $this->addForeignKey('trafficItemIcon_FK', 'agi_traffic_item', 'iconId', 'agi_traffic_item_icon', 'id', 'SET NULL', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('agi_traffic_item_icon');
    }
}
