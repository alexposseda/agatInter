<?php

    use yii\db\Migration;

    class m160831_135833_insert_admin_to_user_table extends Migration{
        public function up(){
            $this->insert('{{%user}}', [
                'username'      => 'admin',
                'password_hash' => '$2y$13$0XUYaKcX4ae0K0CIz3o60.d7cYOPUwIcWXl0Mx.xcvmSKXNUARDaS',
                'status'        => 10
            ]);
        }

        public function down(){
            $this->delete('{{%user}}', ['username' => 'admin']);

            return false;
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
