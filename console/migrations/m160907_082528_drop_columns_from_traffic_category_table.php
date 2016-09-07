<?php

use yii\db\Migration;

/**
 * Handles dropping description, cover and map from table `traffic_category`.
 */
class m160907_082528_drop_columns_from_traffic_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('agi_traffic_category', 'description');
        $this->dropColumn('agi_traffic_category', 'cover');
        $this->dropColumn('agi_traffic_category', 'map');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('agi_traffic_category', 'description', $this->text());
        $this->addColumn('agi_traffic_category', 'cover', $this->string());
        $this->addColumn('agi_traffic_category', 'map', $this->text());
    }
}
