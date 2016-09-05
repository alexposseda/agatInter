<?php

use yii\db\Migration;

/**
 * Handles dropping parentCategory from table `agi_traffic_category`.
 */
class m160815_103709_drop_parentCategory_column_from_agi_traffic_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('agi_traffic_category','parentCategory');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('agi_traffic_category','parentCategory',$this->integer());
    }
}
