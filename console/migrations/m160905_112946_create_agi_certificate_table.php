<?php

use yii\db\Migration;

/**
 * Handles the creation for table `agi_certificate`.
 */
class m160905_112946_create_agi_certificate_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('agi_certificate', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'short_description' => $this->text(),
            'full_description' => $this->text(),
            'icon' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('agi_certificate');
    }
}
