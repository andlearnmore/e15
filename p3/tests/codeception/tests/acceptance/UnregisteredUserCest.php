<?php

class UnregisteredUserCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/test/refresh-database');

    }

    // tests
    public function CantAccessCityDetails(AcceptanceTester $I)
    {

        $I->amOnPage('/cities');

        # Test that no links are available on All Cities page when not logged in.
        $I->seeElement('[test=login-encourage]');

        $I->amOnPage('/AT/gmunden');

        $I->see('Login');

        }
}