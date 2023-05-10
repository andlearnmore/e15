<?php

class MyTripCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/test/refresh-database');
    }

    // tests

    public function UserWithEmptyMyTrip(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/3');
        $I->amOnPage('/mytrip');
        $I->seeElement('[test=no-places]');

    }



}