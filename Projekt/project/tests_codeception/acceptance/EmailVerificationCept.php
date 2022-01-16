<?php
$I = new AcceptanceTester($scenario ?? null);

$I->wantTo('verify email');

$I->amOnPage('/login');

$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');

$I->click('Log in');

$I->seeCurrentUrlEquals('/dashboard');

$my_name = $I->grabFromDatabase('users', 'name', array('name' => 'John Doe'));
$I->see($my_name."'s account");

$I->see('Verified:');
$I->see('no');
$I->click("Verify account");

$I->seeCurrentUrlEquals('/verify-email');

$I->see('Thanks for verifying your email!');
$I->dontSee('A new verification link has been sent to the email address you provided during registration.');

$I->click("Resend Verification Email");
$I->seeCurrentUrlEquals('/verify-email');
$I->see('A new verification link has been sent to the email address you provided during registration.');

$I->click('I have verified my email');
$I->seeCurrentUrlEquals('/dashboard');

$I->see('Verified:');
$I->see('yes');
