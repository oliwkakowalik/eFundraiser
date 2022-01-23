<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('Test Filtration');

$I->amOnPage('/fundraisers');
$I->see('Filtration Catalog', 'h3');
$I->see('Sort', 'h3');

$I->see('Na schronisko dla kotków');
$I->see('Na schronisko dla piesków');
$I->see('Prezent dla taty');

$I->selectOption("select", 'Animals');
$I->click('Filter');

$I->see('Na schronisko dla kotków');
$I->see('Na schronisko dla piesków');
$I->dontsee('Prezent dla taty');

$I->click('Show All');

$I->see('Na schronisko dla kotków');
$I->see('Na schronisko dla piesków');
$I->see('Prezent dla taty');

$I->fillField('amount_to_be_raised', '3000');
$I->click('Filter');

$I->dontsee('Na schronisko dla kotków');
$I->dontsee('Na schronisko dla piesków');
$I->dontsee('Prezent dla taty');

$I->selectOption("select", 'Animals');
$I->fillField('amount_to_be_raised', '6000');
$I->click('Filter');

$I->see('Na schronisko dla kotków');
$I->see('Na schronisko dla królików');
$I->dontsee('Na schronisko dla piesków');
$I->dontsee('Prezent dla taty');
