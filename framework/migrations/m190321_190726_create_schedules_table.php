<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%schedules}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%stations}}`
 * - `{{%stations}}`
 * - `{{%carriers}}`
 */
class m190321_190726_create_schedules_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%schedules}}', [
            'id' => $this->primaryKey(),
            'start_station_id' => $this->integer()->notNull(),
            'end_station_id' => $this->integer()->notNull(),
            'carrier_id' => $this->integer()->notNull(),
            'start_time' => $this->time(),
            'end_time' => $this->time(),
            'price' => $this->float(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        // creates index for column `start_station_id`
        $this->createIndex(
            '{{%idx-schedules-start_station_id}}',
            '{{%schedules}}',
            'start_station_id'
        );

        // add foreign key for table `{{%stations}}`
        $this->addForeignKey(
            '{{%fk-schedules-start_station_id}}',
            '{{%schedules}}',
            'start_station_id',
            '{{%stations}}',
            'id',
            'CASCADE'
        );

        // creates index for column `end_station_id`
        $this->createIndex(
            '{{%idx-schedules-end_station_id}}',
            '{{%schedules}}',
            'end_station_id'
        );

        // add foreign key for table `{{%stations}}`
        $this->addForeignKey(
            '{{%fk-schedules-end_station_id}}',
            '{{%schedules}}',
            'end_station_id',
            '{{%stations}}',
            'id',
            'CASCADE'
        );

        // creates index for column `carrier_id`
        $this->createIndex(
            '{{%idx-schedules-carrier_id}}',
            '{{%schedules}}',
            'carrier_id'
        );

        // add foreign key for table `{{%carriers}}`
        $this->addForeignKey(
            '{{%fk-schedules-carrier_id}}',
            '{{%schedules}}',
            'carrier_id',
            '{{%carriers}}',
            'id',
            'CASCADE'
        );



        $schedules = array(
            array('id' => '1','start_station_id' => '1','end_station_id' => '2','carrier_id' => '1','start_time' => '13:12:00','end_time' => '12:23:00','price' => '11111'),
            array('id' => '2','start_station_id' => '3','end_station_id' => '1','carrier_id' => '2','start_time' => '23:12:00','end_time' => '12:23:00','price' => '111')
          );

        foreach ($schedules as $v) {
            $this->insert('{{%schedules}}', $v);
        }






    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%stations}}`
        $this->dropForeignKey(
            '{{%fk-schedules-start_station_id}}',
            '{{%schedules}}'
        );

        // drops index for column `start_station_id`
        $this->dropIndex(
            '{{%idx-schedules-start_station_id}}',
            '{{%schedules}}'
        );

        // drops foreign key for table `{{%stations}}`
        $this->dropForeignKey(
            '{{%fk-schedules-end_station_id}}',
            '{{%schedules}}'
        );

        // drops index for column `end_station_id`
        $this->dropIndex(
            '{{%idx-schedules-end_station_id}}',
            '{{%schedules}}'
        );

        // drops foreign key for table `{{%carriers}}`
        $this->dropForeignKey(
            '{{%fk-schedules-carrier_id}}',
            '{{%schedules}}'
        );

        // drops index for column `carrier_id`
        $this->dropIndex(
            '{{%idx-schedules-carrier_id}}',
            '{{%schedules}}'
        );

        $this->dropTable('{{%schedules}}');
    }
}
