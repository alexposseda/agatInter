<?php

    use yii\db\Migration;

    /**
     * Handles the creation for table `agi_gallery_category`.
     */
    class m160810_095622_create_agi_gallery_category_table extends Migration{
        /**
         * @inheritdoc
         */
        public
        function up(){
            $this->createTable(
                'agi_gallery_category',
                [
                    'id' => $this->primaryKey(),
                    'title' => $this->string(),
                ]
            );
        }

        /**
         * @inheritdoc
         */
        public
        function down(){
            $this->dropTable('agi_gallery_category');
        }
    }
