<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "days".
 *
 * @property string $id Первичный ключ
 * @property string $id_schedule Расписание
 * @property int $day_of_week День недели
 *
 * @property Schedules $schedule
 */
class Days extends \yii\db\ActiveRecord
{

    public static $days_of_week = [
        1 => 'Понедельник',
        2 => 'Вторник',
        3 => 'Среда',
        4 => 'Четверг',
        5 => 'Пятница',
        6 => 'Суббота',
        7 => 'Воскресенье',
    ];


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'days';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_schedule', 'day_of_week'], 'required'],
            [['id_schedule', 'day_of_week'], 'integer'],
            [['id_schedule'], 'exist', 'skipOnError' => true, 'targetClass' => Schedules::className(), 'targetAttribute' => ['id_schedule' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Первичный ключ',
            'id_schedule' => 'Расписание',
            'day_of_week' => 'День недели',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedule()
    {
        return $this->hasOne(Schedules::className(), ['id' => 'id_schedule']);
    }
}
