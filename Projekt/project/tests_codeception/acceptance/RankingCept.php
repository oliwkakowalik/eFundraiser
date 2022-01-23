<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('have working ranking');

$I->amOnPage('/login');
$I->fillField('email', 'julia.perry@gmail.com');
$I->fillField('password', 'secret');
$I->click('Log in');

$I->amOnPage('/');

$I->seeLink("Beatrice Travers");
$I->seeLink("Olga Śmistek");
$I->seeLink("Oliwia Kowalik");

$I->dontSeeLink("Julia Perry");

$I->click('Fundraisers');
$I->click('Piłki do siatkówki');
$I->click('Make a donation');


$I->seeCurrentUrlEquals('/fundraisers/13/donations/create');

$amount = '150000';
$description = 'Test Description';
$is_anonymous = '0';

$I->fillField('amount', $amount);
$I->fillField('description', $description);
$I->selectOption("select", $is_anonymous);

$I->click('Make a donation');

$I->amOnPage('/');

$I->seeLink("Beatrice Travers");
$I->seeLink("Olga Śmistek");
$I->seeLink("Julia Perry");

$I->dontSeeLink("Oliwia Kowalik");

