<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "carriers".
 *
 * @property string $id Первичный ключ
 * @property string $name Имя перевозчика
 * @property int $active Активность записи
 *
 * @property Schedules[] $schedules
 */
class Carriers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carriers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'name' => 'Имя перевозчика',
            'active' => 'Активность записи',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedules::className(), ['carrier_id' => 'id']);
    }
}
