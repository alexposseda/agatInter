<?php

use yii\db\Migration;

class m160815_140240_drop_trafficCategory_FK_agi_traffic_item extends Migration
{
    public function up()
    {
        $this->dropForeignKey('trafficCategory_FK','agi_traffic_item');
        $this->addForeignKey('trafficCategory_FK', 'agi_traffic_item', 'categoryId', 'agi_traffic_category', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('trafficCategory_FK','agi_traffic_item');
        $this->addForeignKey('trafficCategory_FK', 'agi_traffic_item', 'categoryId', 'agi_traffic_category', 'id', 'SET NULL', 'CASCADE');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
