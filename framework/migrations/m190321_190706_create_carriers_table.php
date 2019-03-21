<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%carriers}}`.
 */
class m190321_190706_create_carriers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%carriers}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(200)->append('CHARACTER SET utf8 COLLATE utf8_general_ci'),
            'active' => $this->integer()->defaultValue(1),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $carriers = array(
            array('id' => '1','name' => 'ОдессаТранс','active' => '1'),
            array('id' => '2','name' => 'КиевТранс','active' => '1'),
          );

        foreach ($carriers as $v) {
            $this->insert('{{%carriers}}', $v);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%carriers}}');
    }
}
