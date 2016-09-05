<?php

use yii\db\Migration;

/**
 * Handles the creation for table `agi_traffic_item`.
 */
class m160810_095116_create_agi_traffic_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('agi_traffic_item', [
            'id' => $this->primaryKey(),
            'categoryId' => $this->integer()->null(),
            'title' => $this->string(),
            'cover' => $this->string(),
            'description' => $this->text()
        ]);

        $this->createIndex('trafficCategoryId', 'agi_traffic_item', 'categoryId');

        $this->addForeignKey('trafficCategory_FK', 'agi_traffic_item', 'categoryId', 'agi_traffic_category', 'id', 'SET NULL', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('trafficCategory_FK', 'agi_traffic_item');
        $this->dropTable('agi_traffic_item');
    }
}
