<?php
    use yii\db\Migration;

    /**
     * Handles the creation for table `agi_traffic_category`.
     */
    class m160810_094723_create_agi_traffic_category_table extends Migration{
        /**
         * @inheritdoc
         */
        public
        function up(){
            $this->createTable(
                'agi_traffic_category', [
                'id' => $this->primaryKey(),
                'title' => $this->string(),
                'parentCategory' => $this->integer()->null()
            ]
            );
            $this->createIndex('parentCat', 'agi_traffic_category', 'parentCategory');
        }

        /**
         * @inheritdoc
         */
        public
        function down(){
            $this->dropTable('agi_traffic_category');
        }
    }
