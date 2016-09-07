<?php

use yii\db\Migration;

class m160907_133702_insert_into_traffic_item_icon_table extends Migration
{
    public function up()
    {
        $this->insert('agi_traffic_item_icon', ['icon'=>'icons/ship.png']);
    }

    public function down()
    {
        $this->delete('agi_traffic_item_icon', ['icon'=>'icons/ship.png']);
    }
}
