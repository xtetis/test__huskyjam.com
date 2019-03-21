<?php

namespace app\models;

use Yii;
use app\models\Days;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "schedules".
 *
 * @property string $id Первичный ключ
 * @property string $start_station_id Станция отправления
 * @property string $end_station_id Станция прибытия
 * @property string $carrier_id Перевозчик
 * @property string $start_time Время отправления
 * @property string $end_time Время прибытия
 * @property double $price Цена проезда
 *
 * @property Days[] $days
 * @property Carriers $carrier
 * @property Stations $startStation
 * @property Stations $endStation
 */
class Schedules extends \yii\db\ActiveRecord
{



    public $days;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schedules';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_station_id', 'end_station_id', 'carrier_id', 'start_time', 'end_time', 'price'], 'required'],
            [['start_station_id', 'end_station_id', 'carrier_id'], 'integer'],
            [['start_time', 'end_time','days'], 'safe'],
            [['start_time','end_time'], 'validateTime'],

            [['price'], 'number'],
            [['carrier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carriers::className(), 'targetAttribute' => ['carrier_id' => 'id']],
            [['start_station_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stations::className(), 'targetAttribute' => ['start_station_id' => 'id']],
            [['end_station_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stations::className(), 'targetAttribute' => ['end_station_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Первичный ключ',
            'start_station_id' => 'Станция отправления',
            'end_station_id' => 'Станция прибытия',
            'carrier_id' => 'Перевозчик',
            'start_time' => 'Время отправления',
            'end_time' => 'Время прибытия',
            'price' => 'Цена проезда',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDays()
    {
        return $this->hasMany(Days::className(), ['id_schedule' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarrier()
    {
        return $this->hasOne(Carriers::className(), ['id' => 'carrier_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStartStation()
    {
        return $this->hasOne(Stations::className(), ['id' => 'start_station_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEndStation()
    {
        return $this->hasOne(Stations::className(), ['id' => 'end_station_id']);
    }

    public function validateTime(
        $attribute_name,
        $params
    )
    {
        $time = $this->$attribute_name;
        $timearr = explode(':',$time);
        if (count($timearr)!=2)
        {
            $this->addError($attribute_name, 'Некорректное время');
            return false;
        }

        foreach ($timearr as $item) {
            $nums = preg_replace('/[^0-9]/', '', $item);
            if ($nums != $item)
            {
                $this->addError($attribute_name, 'Некорректное время');
                return false;
            }
        }

        if (intval($timearr[0])>23)
        {
            $this->addError($attribute_name, 'Некорректное время');
            return false;
        }

        if (intval($timearr[1])>59)
        {
            $this->addError($attribute_name, 'Некорректное время');
            return false;
        }

        return true;
    }





    public function getDiffStartEndTime()
    {

        $to_time = strtotime($this->end_time);
        $from_time = strtotime($this->start_time);
        $d00 = strtotime('00:00');
        $d24 = strtotime('24:00');
        
        $diff_start_minutes = round(abs($d00 - $from_time) / 60,2);
        $diff_end_minutes = round(abs($d00 - $to_time) / 60,2);
        $diff_24_minutes = round(abs($d24 - $d00) / 60,2);
        
        $diff_result = 0;
        if ($diff_start_minutes > $diff_end_minutes)
        {
            $diff_result = $diff_24_minutes - $diff_start_minutes + $diff_end_minutes;
        }
        else
        {
            $diff_result = $diff_end_minutes - $diff_start_minutes;
        }

        $hours = floor($diff_result / 60);
        $minutes = $diff_result % 60;

        return $hours.' часов и '.$minutes.' минут';
    }







    public function getDaysNames()
    {
        return implode(', ',array_intersect_key(Days::$days_of_week,ArrayHelper::map($this->getDays()->all(),'day_of_week','day_of_week')));
    }
}
