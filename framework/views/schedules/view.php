<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\models\Days;


/* @var $this yii\web\View */
/* @var $model app\models\Schedules */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="schedules-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'start_station_id',
            'end_station_id',
            'carrier_id',
            'start_time',
            'end_time',
            'price',
            [
                'label' => 'График движения	',
                'value' => implode(',',array_intersect_key(Days::$days_of_week,ArrayHelper::map($model->getDays()->all(),'day_of_week','day_of_week'))),
            ],
        ],
    ]) ?>

</div>
