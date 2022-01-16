<?php
$I = new AcceptanceTester($scenario ?? null);

$I->wantTo('have users page');

$I->amOnPage('/');
$I->click('Users');
$I->seeCurrentUrlEquals('/users');


$I->see('List of users', 'h2');

$I->click('Log in');
$I->amOnPage('/login');

$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');

$I->click('Log in');

$I->seeCurrentUrlEquals('/dashboard');

$I->click('Users');
$I->seeCurrentUrlEquals('/users');

$I->see('List of users', 'h2');

$name = $I->grabFromDatabase('users', 'name', array('name' => 'Olga Śmistek'));
$id = $I->grabFromDatabase('users', 'id', array('name' => 'Olga Śmistek'));
$email = $I->grabFromDatabase('users', 'email', array('name' => 'Olga Śmistek'));

$I->see($name);
$I->click('View '.$name.' profile');

$I->seeCurrentUrlEquals('/users/'.$id);

$I->see($name."'s account", 'h2');


$I->see($email);

$I->click('Users');
$I->seeCurrentUrlEquals('/users');

$my_name = $I->grabFromDatabase('users', 'name', array('name' => 'John Doe'));
$I->click('View '.$my_name.' profile');

$I->seeCurrentUrlEquals('/dashboard');

$I->see($my_name."'s account");

$I->click("Verify account");
