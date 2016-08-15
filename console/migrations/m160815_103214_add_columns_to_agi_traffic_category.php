<?php

    use yii\db\Migration;

    class m160815_103214_add_columns_to_agi_traffic_category extends Migration{
        public function up(){
            $this->addColumn('agi_traffic_category', 'description', $this->text());
            $this->addColumn('agi_traffic_category', 'cover', $this->string());
            $this->addColumn('agi_traffic_category', 'map', $this->text());
        }

        public function down(){
            $this->dropColumn('agi_traffic_category', 'description');
            $this->dropColumn('agi_traffic_category', 'cover');
            $this->dropColumn('agi_traffic_category', 'map');
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
