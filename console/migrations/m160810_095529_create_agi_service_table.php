<?php

    use yii\db\Migration;

    /**
     * Handles the creation for table `agi_service`.
     */
    class m160810_095529_create_agi_service_table extends Migration{
        /**
         * @inheritdoc
         */
        public
        function up(){
            $this->createTable(
                'agi_service',
                [
                    'id' => $this->primaryKey(),
                    'title' => $this->string(),
                    'short_description' => $this->text(),
                    'full_description' => $this->text(),
                    'icon' => $this->string(),
                ]
            );
        }

        /**
         * @inheritdoc
         */
        public
        function down(){
            $this->dropTable('agi_service');
        }
    }
