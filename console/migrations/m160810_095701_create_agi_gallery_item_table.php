<?php

    use yii\db\Migration;

    /**
     * Handles the creation for table `agi_gallery_item`.
     */
    class m160810_095701_create_agi_gallery_item_table extends Migration{
        /**
         * @inheritdoc
         */
        public
        function up(){
            $this->createTable(
                'agi_gallery_item',
                [
                    'id' => $this->primaryKey(),
                    'categoryId' => $this->integer(),
                    'picture' => $this->string(),
                    'description' => $this->text()
                ]
            );

            $this->createIndex('categoryId', 'agi_gallery_item', 'categoryId');
            $this->addForeignKey(
                'categoryId_FK', 'agi_gallery_item', 'categoryId', 'agi_gallery_category', 'id', 'SET NULL', 'CASCADE'
            );
        }

        /**
         * @inheritdoc
         */
        public
        function down(){
            $this->dropForeignKey('categoryId_FK', 'api_gallery_item');
            $this->dropTable('api_gallery_item');
        }
    }
