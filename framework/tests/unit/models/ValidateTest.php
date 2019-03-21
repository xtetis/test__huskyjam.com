<?php

namespace tests\unit\models;

use app\models\Stations;
use app\models\Carriers;
use app\models\Schedules;



class ValidateTest extends \Codeception\Test\Unit
{

    public function testValidateStation()
    {
        $station = new Stations();
        expect_that(count($station->errors) == 0);

        $station->name = '';
        $station->active = 'zzz';
        $station->validate();
        expect_that(count($station->errors) != 0);

    }

    public function testValidateCarrier()
    {
        $carrier = new Carriers();
        expect_that(count($carrier->errors) == 0);

        $carrier->name = '';
        $carrier->active = 'zzz';
        $carrier->validate();
        expect_that(count($carrier->errors) != 0);

    }

    public function testValidateSchedule()
    {
        $schedule = new Schedules();
        $schedule->validate();
        expect_that(count($schedule->errors) != 0);
    }
}
