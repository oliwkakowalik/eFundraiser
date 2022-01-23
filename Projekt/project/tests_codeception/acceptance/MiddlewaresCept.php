<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('have to log in to make a donation and be verified to create a fundraiser');

$title = 'Na schronisko dla kotków';

$I->amOnPage('/dashboard');
$I->seeCurrentUrlEquals('/login');

$I->amOnPage('/fundraisers');
$I->click($title);

$I->click('Make a donation');
$I->seeCurrentUrlEquals('/login');

$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');

$I->click('Log in');

$id = $I->grabFromDatabase('fundraisers', 'id', [
    'title' => $title
]);

$I->seeCurrentUrlEquals('/fundraisers/'.$id.'/donations/create');
$I->see('Making a donation');


$I->amOnPage('/fundraisers');
$I->click('Create new...');

$I->seeCurrentUrlEquals('/verify-email');
$I->click('I have verified my email');

$I->seeCurrentUrlEquals('/dashboard');

$I->amOnPage('/fundraisers');
$I->click('Create new...');

$I->seeCurrentUrlEquals('/fundraisers/create');
$I->see('Creating a fundraiser');



