<?php

class AllCitiesCest
{
    public function _before(AcceptanceTester $I)
    {
        // $I->amOnPage('/test/refresh-database');
    }

    // tests
    public function UserCanSeeDetails(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/AT/gmunden');
    }
}