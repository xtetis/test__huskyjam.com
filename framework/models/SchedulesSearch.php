<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Schedules;

/**
 * SchedulesSearch represents the model behind the search form of `app\models\Schedules`.
 */
class SchedulesSearch extends Schedules
{

    public $carrier; 


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['start_time', 'end_time'], 'safe'],
            [['price'], 'number'],
            [['carrier', 'carrier_id', 'start_station_id' ,  'end_station_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Schedules::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'end_station_id' => $this->end_station_id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'price' => $this->price,
        ]);

        $query->leftJoin('carriers', 'carriers.id = schedules.carrier_id');
        $query->andFilterWhere([
            'like', 'carriers.name', (string)$this->carrier_id
        ]);

        $query->leftJoin('stations as st1', 'st1.id = schedules.start_station_id');
        $query->andFilterWhere([
            'like', 'st1.name', (string)$this->start_station_id
        ]);


        $query->leftJoin('stations as st', 'st.id = schedules.end_station_id');
        $query->andFilterWhere([
            'like', 'st.name', (string)$this->end_station_id
        ]);


        return $dataProvider;
    }
}
