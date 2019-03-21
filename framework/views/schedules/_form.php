<?php

    use app\models\Carriers;
    use app\models\Stations;
    use app\models\Days;
    
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    /* @var $this yii\web\View */
    /* @var $model app\models\Schedules */
    /* @var $form yii\widgets\ActiveForm */

    $stations_array = ArrayHelper::map(Stations::find()->where(["active" => 1])->all(), 'id', 'name');
    $carriers_array = ArrayHelper::map(Carriers::find()->where(["active" => 1])->all(), 'id', 'name');

    $days_selected_array = ArrayHelper::map(Days::find()->where(["id_schedule" => $model->id])->all(), 'day_of_week','day_of_week');
    
    foreach ($days_selected_array as $key => &$value) {
        $value = ['selected' => 'selected'];
    }

?>


<div class="schedules-form">

    <?php $form = ActiveForm::begin();?>

    <?=$form->field($model, 'start_station_id')->dropDownList($stations_array)?>

    <?=$form->field($model, 'end_station_id')->dropDownList($stations_array)?>

    <?=$form->field($model, 'carrier_id')->dropDownList($carriers_array)?>

    <?=$form->field($model, 'start_time')->textInput(
    [
        'class'    => 'form-control datestartend',
        'style'    => 'background:#fff;',
    ]
)?>

    <?=$form->field($model, 'end_time')->textInput(
    [
        'class'    => 'form-control datestartend',
        'style'    => 'background:#fff;',
    ]
)?>

    <?=$form->field($model, 'price')->textInput(
    [
        'class'    => 'form-control floatval',
    ]
)?>

    <?//= $form->field($model, 'days')->textInput() ?>

    <?=$form->field($model, 'days',[
  'template' => '
    {label}
    (<label><input type="checkbox" onchange="$(\'#schedules-days option\').prop(\'selected\', $(this).prop(\'checked\'));"> Все дни</label>)
    
     {input} {error}
'
])
->listBox(Days::$days_of_week,
    [
        'multiple' => true,
        'style'    => 'height: -webkit-fill-available;',
        'options' => $days_selected_array,
    ]);
?>

    <div class="form-group">
        <?=Html::submitButton('Сохранить', ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
