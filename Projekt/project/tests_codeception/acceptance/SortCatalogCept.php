<?php
use Codeception\Util\Locator;

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('Test Sorting');

$I->amOnPage('/fundraisers');

$I->click('Amount ↓');

$I->see('Wynalazek',Locator::elementAt('//tbody/tr/td/a', 1));
$I->see('Odbudowa domu po uderzeniu meteorytu',Locator::elementAt('//tbody/tr/td/a', 2));
$I->see('Badania',Locator::elementAt('//tbody/tr/td/a', 3));

$I->click('Amount ↑');

$I->see('Koc',Locator::elementAt('//tbody/tr/td/a', 1));
$I->see('Prezent dla taty',Locator::elementAt('//tbody/tr/td/a', 2));
$I->see('Wydanie czasopisma',Locator::elementAt('//tbody/tr/td/a', 3));

$I->click('End Date ↑');

$I->see('Koc',Locator::elementAt('//tbody/tr/td/a', 1));
$I->see('Komputer',Locator::elementAt('//tbody/tr/td/a', 2));
$I->see('Prezent dla brata',Locator::elementAt('//tbody/tr/td/a', 3));

$I->click('End Date ↓');

$I->see('Odbudowa domu po pożarze',Locator::elementAt('//tbody/tr/td/a', 1));
$I->see('Wydanie filmu',Locator::elementAt('//tbody/tr/td/a', 2));
$I->see('Na leczenie dla Zosi',Locator::elementAt('//tbody/tr/td/a', 3));

$I->selectOption("select", 'Science');
$I->fillField('amount_to_be_raised', '6000');
$I->click('Filter');

$I->see('Wynalazek',Locator::elementAt('//tbody/tr/td/a', 1));
$I->see('Eksperymenty',Locator::elementAt('//tbody/tr/td/a', 2));
$I->see('Badania',Locator::elementAt('//tbody/tr/td/a', 3));

$I->click('Amount ↓');

$I->see('Wynalazek',Locator::elementAt('//tbody/tr/td/a', 1));
$I->see('Badania',Locator::elementAt('//tbody/tr/td/a', 2));
$I->see('Eksperymenty',Locator::elementAt('//tbody/tr/td/a', 3));
