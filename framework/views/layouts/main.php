<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="/theme/components/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
    NavBar::begin([
        'brandLabel' => 'Тест',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],
            !Yii::$app->user->isGuest?(['label' => 'Перевозчики', 'url' => ['/carriers/index']]):(''),
            !Yii::$app->user->isGuest?(['label' => 'Станции', 'url' => ['/stations/index']]):(''),
            !Yii::$app->user->isGuest?(['label' => 'Расписания', 'url' => ['/schedules/index']]):(''),
            Yii::$app->user->isGuest ? (
                ['label' => 'Авторизация', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
                ),
        ],
    ]);
    NavBar::end();
    ?>

        <div class="container">
            <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
            <?= $content ?>
        </div>
    </div>

    <?php $this->endBody() ?>
    <script src="/theme/js/jquery.maskedinput.js "></script>
    <script src="/theme/js/common.js?v=<?=uniqid()?>"></script>
</body>

</html>
<?php $this->endPage() ?>