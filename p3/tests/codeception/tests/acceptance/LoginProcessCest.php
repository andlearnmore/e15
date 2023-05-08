<?php

class LoginProcessCest
{
    /**
     *
     */
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/test/refresh-database');
    }
 
    /**
     * COPIED FROM BOOKMARK
     */
    public function userCanRegister(AcceptanceTester $I)
    {
        $name = 'Test User';
        $I->amOnPage('/register');
        $I->fillField('[test=name-input]', $name);
        $I->fillField('[test=email-input]', 'test@email.com');
        $I->fillField('[test=password-input]', 'asdfasdf');
        $I->fillField('[test=password-confirmation-input]', 'asdfasdf');
        $I->click('[test=register-button]');

        # Assert
        $I->see($name);

    }

    /**
     * COPIED FROM BOOKMARK
     */
    public function registrationIsValidated(AcceptanceTester $I)
    {
        # Act
        $name = 'Test User';
        $I->amOnPage('/register');
        $I->fillField('[test=name-input]', $name);
        $I->fillField('[test=email-input]', 'jill@harvard.edu');
        $I->fillField('[test=password-input]', 'asdfasdf');
        $I->fillField('[test=password-confirmation-input]', 'asdfasdf');
        $I->click('[test=register-button]');

        # Assert
        $I->see('The email has already been taken.');
    }
    
    /**
     * COPIED FROM BOOKMARK
     */
    public function userCanLogIn(AcceptanceTester $I)
    {
        # Act
        $I->amOnPage('/login');

        # Interact with form elements
        $I->fillField('[test=email-input]', 'jill@harvard.edu');
        $I->fillField('[test=password-input]', 'asdfasdf');
        $I->click('[test=login-button]');

        # Assert expected results
        $I->see('Jill Harvard');

        # Assert the existence of text within a specific element on the page
        $I->see('Logout', 'nav');
    }

    /**
     * COPIED FROM BOOKMARK
     */
    public function userCanLogout(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/');
        $I->click('[test=logout-button]');
        $I->seeElement('[test=login-link]');
    }

    /**
     * COPIED FROM BOOKMARK
     */
    public function loginIsValidated(AcceptanceTester $I)
    {
        # Act
        $I->amOnPage('/login');
        $I->fillField('[test=email-input]', 'jill@harvard.edu');
        $I->fillField('[test=password-input]', 'bad-password');
        $I->click('[test=login-button]');

        # Assert
        $I->see('These credentials do not match our records.');
    }

}