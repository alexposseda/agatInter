<?php

use yii\db\Migration;

/**
 * Handles the creation for table `agi_setting`.
 */
class m160810_114616_create_agi_setting_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('agi_setting', [
            'id' => $this->primaryKey(),
            'settingName' => $this->string()->unique(),
            'settingValue' => $this->string()
        ]);
        $this->insert('agi_setting',['settingName'=>'supportMail', 'settingValue'=>'support@example.com']);
        $this->insert('agi_setting',['settingName'=>'robotMail', 'settingValue'=>'robot@example.com']);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('agi_setting');
    }
}
