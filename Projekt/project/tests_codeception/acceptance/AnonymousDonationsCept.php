<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('have anonymous donations working');

$I->amOnPage('/login');
$I->fillField('email', 'julia.perry@gmail.com');
$I->fillField('password', 'secret');
$I->click('Log in');

$I->amOnPage('/dashboard');

$I->see("0/0");

$I->click('Fundraisers');
$I->click('Piłki do siatkówki');
$I->click('Make a donation');

$I->seeCurrentUrlEquals('/fundraisers/13/donations/create');

$amount = '12';
$description = 'Test Description';
$is_anonymous = '1';

$I->fillField('amount', $amount);
$I->fillField('description', $description);
$I->selectOption("select", $is_anonymous);

$I->click('Make a donation');

$idDonation = $I->grabFromDatabase('donations', 'id', [
    'amount' => $amount,
    'description' => $description,
    'is_anonymous' => $is_anonymous,
]);

$I->seeCurrentUrlEquals('/fundraisers/13/donations/' . $idDonation);

$I->see("Anonymous donation");

$I->amOnPage('/dashboard');

$I->see("0/12");

$I->click('Fundraisers');
$I->click('Wydanie czasopisma');
$I->click('Make a donation');

$I->seeCurrentUrlEquals('/fundraisers/12/donations/create');

$amount = '15';
$description = 'Test Description2';
$is_anonymous = '0';

$I->fillField('amount', $amount);
$I->fillField('description', $description);
$I->selectOption("select", $is_anonymous);

$I->click('Make a donation');

$idDonation2 = $I->grabFromDatabase('donations', 'id', [
    'amount' => $amount,
    'description' => $description,
    'is_anonymous' => $is_anonymous,
]);

$I->seeCurrentUrlEquals('/fundraisers/12/donations/' . $idDonation2);

$I->seeLink("Julia Perry");

$I->click("Julia Perry");

$I->see("15/27");
$I->seeLink("15");

$I->click("Log Out");

$I->amOnPage('/');
$I->seeCurrentUrlEquals('/');

$I->amOnPage('/login');
$I->fillField('email', 'oliwia.kowalik@gmail.com');
$I->fillField('password', 'secret');
$I->click('Log in');
