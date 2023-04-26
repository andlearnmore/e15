<?php

class BookSearchPageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function searchForExistingBook(AcceptanceTester $I)
    {
        $I->amOnPage('/');

        $I->see('Search Terms');
        $I->dontSee('search-results-list');

        $I->submitForm('search-form', array(
            '[test=searchTerms]' => 'Becoming',
            '[test=search-type-title]' => true,
        ));

        # Assert there is a book result
        $I->see('[test=search-results-list]');
    }
}