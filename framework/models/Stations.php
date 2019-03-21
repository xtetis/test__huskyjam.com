<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stations".
 *
 * @property string $id Первичный ключ
 * @property string $name Имя станции
 * @property int $active Активность записи
 *
 * @property Schedules[] $schedules
 * @property Schedules[] $schedules0
 */
class Stations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Первичный ключ',
            'name' => 'Имя станции',
            'active' => 'Активность записи',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedules::className(), ['start_station_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules0()
    {
        return $this->hasMany(Schedules::className(), ['end_station_id' => 'id']);
    }
}
