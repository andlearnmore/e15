<?php

use Codeception\Lib\Generator\Actor;

class LoginPageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function pageLoads(AcceptanceTester $I)
    {
        # Act
        $I->amOnPage('/login');

        # Assert the existence of certain text on the page
        $I->see('Login');

        # Assert the existence of a certain element on the page
        $I->seeElement('#email');
    }
     
    public function userCanLogIn(AcceptanceTester $I)
    {
        # Act

        $I->amOnPage('/login');
        
        # Interact with form elements
        $I->fillField('[name=email]', 'jill@harvard.edu');
        $I->fillField('[name=password]', 'asdfasdf');
        $I->click('login-button');

        # Assert expected results
        $I->see('Jill Harvard');

        # Assert the existence of text within a specific element on the page
        $I->see('Logout', 'nav');
    }

    public function userCanLogOut(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/2');
        $I->amOnPage('/');

        $I->see('Jill Harvard');

        $I->click('logout');

        $I->dontSee('[test=add-book]');

    }

    public function accessPageNotAuthenticated(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->dontSee('[test=add-book]');

        // TODO: figure out how to get to '/book' and be rerouted to login page.

    }
}