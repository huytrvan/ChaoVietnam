<?php

class SigninCest
{

    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function SigninPageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/sign-in');
        $I->see('username');
        $I->dontSeeElement('#alert');
    }

    public function SigninWorks(AcceptanceTester $I)
    {
        $user = ['huy3', '4'];
        $I->amOnPage('/sign-in');
        $I->fillField('username', $user[0]);
        $I->fillField('password', $user[1]);
        $I->click('#submit button');
        $I->see('Welcome');
    }
}
