<?php

class UnregisteredUserCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        I->amOnPage('/cities');
    }
}