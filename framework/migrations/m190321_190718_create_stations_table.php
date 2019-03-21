<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stations}}`.
 */
class m190321_190718_create_stations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stations}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(200)->append('CHARACTER SET utf8 COLLATE utf8_general_ci'),
            'active' => $this->integer()->defaultValue(1),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');


        $stations = array(
            array('id' => '1','name' => 'Киев','active' => '1'),
            array('id' => '2','name' => 'Одесса','active' => '1'),
            array('id' => '3','name' => 'Москва','active' => '1'),
          );

        foreach ($stations as $v) {
            $this->insert('{{%stations}}', $v);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%stations}}');
    }
}
