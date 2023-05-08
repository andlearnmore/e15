<?php

class MyTripCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/test/refresh-database');
    }

    // tests
    public function AddACity(AcceptanceTester $I)
    {
        
        $I->amOnPage('/test/login-as/2');

        $I->amOnPage('/mytrip');
        $I->dontSeeElement('[test=no-places]');
        $I->dontSee('Cologne');

        $I->amOnPage('/DE/cologne');
        $I->click('Schokoladen Museum');
        $I->click('Save');
        $I->seeInCurrentUrl('/mytrip');
        $I->see('Cologne');
    }

    public function UserWithEmptyMyTrip(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/3');
        $I->amOnPage('/mytrip');
        $I->seeElement('[test=no-places]');

    }

    public function PlaceDetails(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/2');

        $I->amOnPage('/DE/cologne');
        $I->click('Schokoladen Museum');
        $I->see('Rheinauhafen');
        $I->click('[test=nav-back]');
        $I->seeElement('[test=country-page]');
    
    }


}