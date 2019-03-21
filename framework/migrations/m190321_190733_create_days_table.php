<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%days}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%schedules}}`
 */
class m190321_190733_create_days_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%days}}', [
            'id' => $this->primaryKey(),
            'id_schedule' => $this->integer()->notNull(),
            'day_of_week' => $this->integer()->notNull(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        // creates index for column `id_schedule`
        $this->createIndex(
            '{{%idx-days-id_schedule}}',
            '{{%days}}',
            'id_schedule'
        );

        // add foreign key for table `{{%schedules}}`
        $this->addForeignKey(
            '{{%fk-days-id_schedule}}',
            '{{%days}}',
            'id_schedule',
            '{{%schedules}}',
            'id',
            'CASCADE'
        );


        $days = array(
            array('id' => '2','id_schedule' => '1','day_of_week' => '2'),
            array('id' => '3','id_schedule' => '1','day_of_week' => '3'),
            array('id' => '4','id_schedule' => '1','day_of_week' => '4'),
            array('id' => '5','id_schedule' => '1','day_of_week' => '5'),
            array('id' => '6','id_schedule' => '1','day_of_week' => '6'),
            array('id' => '7','id_schedule' => '1','day_of_week' => '7'),
            array('id' => '8','id_schedule' => '2','day_of_week' => '3')
          );
        foreach ($days as $v) {
            $this->insert('{{%days}}', $v);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%schedules}}`
        $this->dropForeignKey(
            '{{%fk-days-id_schedule}}',
            '{{%days}}'
        );

        // drops index for column `id_schedule`
        $this->dropIndex(
            '{{%idx-days-id_schedule}}',
            '{{%days}}'
        );

        $this->dropTable('{{%days}}');
    }
}
