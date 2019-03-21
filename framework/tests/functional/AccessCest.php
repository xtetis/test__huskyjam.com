<?php

class AccessCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['/']);
    }

    public function openMainPage(\FunctionalTester $I)
    {
        $I->see('Расписания маршрутов', 'h1');        
    }

    public function openLoginPage(\FunctionalTester $I)
    {
        $I->amOnPage(['site/login']);
        $I->see('Авторизация', 'h1');        
    }

    public function openStationsPage(\FunctionalTester $I)
    {
        $I->amOnPage(['stations/index']);
        $I->see('Авторизация', 'h1');        
    }

    public function openCarriersPage(\FunctionalTester $I)
    {
        $I->amOnPage(['carriers/index']);
        $I->see('Авторизация', 'h1');        
    }


    public function submitFormLoginSubmit(\FunctionalTester $I)
    {
        $I->amOnPage(['site/login']);
        $I->see('Авторизация', 'h1');   
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'admin',
        ]);
        $I->dontSeeElement('#login-form');
    }



    public function openCarriersPageAuth(\FunctionalTester $I)
    {
        $I->amOnPage(['site/login']);
        $I->see('Авторизация', 'h1');   
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'admin',
        ]);
        $I->dontSeeElement('#login-form');
        $I->amOnPage(['carriers/index']);
        $I->see('Перевозчики', 'h1');        
    }



    public function openStationsPageAuth(\FunctionalTester $I)
    {
        $I->amOnPage(['site/login']);
        $I->see('Авторизация', 'h1');   
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'admin',
        ]);
        $I->dontSeeElement('#login-form');
        $I->amOnPage(['stations/index']);
        $I->see('Станции', 'h1');        
    }

}
