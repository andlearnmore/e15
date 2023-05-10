<?php

class AllCitiesCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/test/refresh-database');
    }

    public function UserCanSeeDetails(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/2');
        $I->amOnPage('/cities');
        $I->click('[test=city-link]');

        $I->see('Explore places to visit');
    }

    public function UserCantAddPlaceAlreadyInMyTrip(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/2');
        $I->amOnPage('/DE/berlin/sherwood-forest-playground');
        $I->dontSee('[test=add-button');

    }

    public function UserCanAddPlaceNotInMyTrip(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/2');
        $I->amOnPage('/DE/berlin/altes-museum');
        $I->click('Save to My Trip');
        $I->see('Altes Museum was added to My Trip.');



    }
}