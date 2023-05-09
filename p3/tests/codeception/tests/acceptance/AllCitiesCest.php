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
        $I->click('Berlin');

        $I->see('Brandenburg Gate');
    }

    public function UserCantAddPlaceAlreadyInMyTrip(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/2');
        $I->amOnPage('/cities');
        $I->click('Berlin');
        $I->click('Sherwood Forest Playground');
        $I->seeInCurrentUrl('DE/berlin/sherwood-forest-playground');
        $I->dontSee('[test=add-button');

    }

    public function UserCanAddPlaceNotInMyTrip(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/2');
        $I->amOnPage('/cities');
        $I->click('Berlin');
        $I->click('Altes Museum');
        $I->click('Save to My Trip');
        $I->see('Altes Museum was added to My Trip.');



    }
}