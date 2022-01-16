<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('check x-markdown');

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('login with existing user');

$I->amOnPage('/dashboard');

$I->seeCurrentUrlEquals('/login');

$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');

$I->click('Log in');

$I->seeCurrentUrlEquals('/dashboard');

$my_name = $I->grabFromDatabase('users', 'name', array('name' => 'John Doe'));

$I->see($my_name."'s account");

$I->amOnPage('/fundraisers');

$I->see("piesków",'strong');
