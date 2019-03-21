<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Days;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SchedulesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Расписания маршрутов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedules-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if (!Yii::$app->user->isGuest): ?>
    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'attribute'=>'start_station_id',
            'value'=>function($data){
                return $data->getStartStation()->one()->name;
            }
        ],
        [
            'attribute'=>'end_station_id',
            'value'=>function($data){
                return $data->getEndStation()->one()->name;
            }
        ],
        [
            'attribute'=>'carrier_id',
            'value'=>function($data){
                return $data->getCarrier()->one()->name;
            }
        ],
        'start_time',
        'end_time',
        'price',
        [
            'label' => 'Время в пути',
            'value' => function ($model) {
                return $model->getDiffStartEndTime();
            }
        ],
        [
            'label' => 'График движения',
            'value' => function ($model) {
                return $model->getDaysNames();
            }
        ],
    ];

    if (!Yii::$app->user->isGuest)
    {
        $columns[]=['class' => 'yii\grid\ActionColumn'];
    }
    ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
    ]); ?>
</div>
